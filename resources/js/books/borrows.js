import './../bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const borrowForm = document.getElementById('borrowForm');
    const borrowList = document.getElementById('borrowList');
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const borrowMember = document.getElementById('borrowMember');
    const borrowBook = document.getElementById('borrowBook');

    loadBorrows();
    loadMembers();
    loadBooks();

    // Load all borrows
    async function loadBorrows() {
        const res = await fetch('/borrows/list');
        const data = await res.json();
        if (!data.borrows.length) {
            borrowList.innerHTML = '<tr><td colspan="7" class="text-center">No borrows found</td></tr>';
            return;
        }

        borrowList.innerHTML = data.borrows.map(b => `
            <tr data-id="${b.id}">
                <td>${b.member.first_name} ${b.member.last_name}</td>
                <td>${b.book.title}</td>
                <td>${b.quantity}</td>
                <td>${b.borrow_date}</td>
                <td>${b.return_date ?? '-'}</td>
                <td>${b.status}</td>
                <td>
                    ${b.status === 'borrowed' ? `<button class="btn btn-outline-success return-btn">Return</button>` : ''}
                </td>
            </tr>
        `).join('');

        document.querySelectorAll('.return-btn').forEach(btn => {
            btn.addEventListener('click', async e => {
                const id = e.target.closest('tr').dataset.id;
                await fetch(`/borrows/return/${id}`, {
                    method: 'PUT',
                    headers: { 'X-CSRF-TOKEN': token }
                });
                loadBorrows();
            });
        });
    }

    // Load all members for select
    async function loadMembers() {
        const res = await fetch('/members/show');
        const data = await res.json();
        borrowMember.innerHTML = `<option value="">Select Member</option>` +
            data.members.map(m => `<option value="${m.id}">${m.first_name} ${m.last_name}</option>`).join('');
    }

    // Load all books for select
    async function loadBooks() {
        const res = await fetch('/books/show');
        const data = await res.json();
        borrowBook.innerHTML = `<option value="">Select Book</option>` +
            data.books.map(b => `<option value="${b.id}">${b.title} (Available: ${b.quantity})</option>`).join('');
    }

    // Borrow a book
    borrowForm.addEventListener('submit', async e => {
        e.preventDefault();
        const member_id = borrowMember.value;
        const book_id = borrowBook.value;
        const quantity = borrowQuantity.value;

        const res = await fetch('/borrows/borrow', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
            body: JSON.stringify({ member_id, book_id, quantity })
        });

        const data = await res.json();
        if (data.success) {
            borrowForm.reset();
            bootstrap.Modal.getInstance(document.getElementById('borrowBookModal')).hide();
            loadBorrows();
        } else alert(data.message);
    });
});
