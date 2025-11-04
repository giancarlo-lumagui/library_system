import './../bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formData');
    const delForm = document.getElementById('delForm');
    const editForm = document.getElementById('editForm');
    const table = document.getElementById('bookList');
    const modalElAdd = document.getElementById('addBookModal');
    const modalElDel = document.getElementById('deleteBookModal');
    const modalElEdit = document.getElementById('editBookModal');
    const searchInput = document.getElementById('searchInput');
    const genreFilter = document.getElementById('genreFilter');
    const clearFilters = document.getElementById('clearFilters');
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const addBook = bootstrap.Modal.getOrCreateInstance(modalElAdd);
    const delBook = bootstrap.Modal.getOrCreateInstance(modalElDel);
    const edBook = bootstrap.Modal.getOrCreateInstance(modalElEdit);

    let deleteId = null;
    let editId = null;
    let currentBooks = [];

    loadBooks();
    loadGenres();

    searchInput.addEventListener('input', debounce(filterBooks, 400)); // delay typing
    genreFilter.addEventListener('change', filterBooks);
    clearFilters.addEventListener('click', () => {
        searchInput.value = '';
        genreFilter.value = 'all';
        loadBooks();
    });

    async function loadGenres() {
        try {
            const res = await fetch('/books/genres');
            const data = await res.json();

            if (!data.success || !data.genres.length) {
                genreFilter.innerHTML = `<option value="all">All Genres</option>`;
                return;
            }

            genreFilter.innerHTML = `
            <option value="all">All Genres</option>
            ${data.genres.map(genre => `<option value="${genre}">${genre}</option>`).join('')}
        `;
        } catch (error) {
            console.error("Error loading genres:", error);
        }
    }


    // Small debounce function to avoid spam-fetching
    function debounce(func, delay) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    table.addEventListener('click', e => {
        const row = e.target.closest('tr');
        if (!row) return;
        const id = row.dataset.id;

        if (e.target.closest('.delete-btn')) deleteBook(id);
        if (e.target.closest('.edit-btn')) editBook(id);
    });

    form.addEventListener('submit', async e => {
        e.preventDefault();

        const title = document.getElementById('title').value;
        const author = document.getElementById('author').value;
        const genre = document.getElementById('genre').value;
        const quantity = document.getElementById('quantity').value;

        const res = await fetch('/books/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ title, author, genre, quantity })
        });

        if (res.ok) {
            addBook.hide();
            form.reset();
            loadBooks();
        } else console.error("Failed to add book");
    });

    async function loadBooks() {
        const res = await fetch('/books/show');
        const data = await res.json();

        renderBooks(data.books);
    }

    // 🔍 Filter books based on search or genre
    async function filterBooks() {
        const search = document.getElementById('searchInput').value.trim();
        const genre = document.getElementById('genreFilter').value;

        const res = await fetch(`/books/filter?search=${encodeURIComponent(search)}&genre=${encodeURIComponent(genre)}`);
        const data = await res.json();

        renderBooks(data.books);
    }

    // 🎨 Helper to render table rows
    function renderBooks(books) {
        if (!books.length) {
            table.innerHTML = '<tr><td colspan="5" class="text-center">No books found</td></tr>';
            return;
        }

        currentBooks = books;
        table.innerHTML = books.map(book => `
        <tr data-id="${book.id}">
            <td>${book.title}</td>
            <td>${book.author}</td>
            <td>${book.genre}</td>
            <td>${book.quantity}</td>
            <td>
                <button class="btn btn-outline-warning edit-btn"><i class="bi bi-pencil"></i></button>
                <button class="btn btn-outline-danger delete-btn"><i class="bi bi-trash"></i></button>
            </td>
        </tr>
    `).join('');
    }

    function deleteBook(id) {
        deleteId = id;
        delBook.show();
    }

    delForm.addEventListener('submit', async e => {
        e.preventDefault();
        if (!deleteId) return;

        const res = await fetch(`/books/${deleteId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token
            }
        });

        if (res.ok) {
            delBook.hide();
            loadBooks();
            deleteId = null;
        } else console.error("Failed to delete book");
    });

    function editBook(id) {
        const book = currentBooks.find(b => b.id == id);
        if (!book) return console.error("Book not found");

        document.getElementById('editTitle').value = book.title;
        document.getElementById('editAuthor').value = book.author;
        document.getElementById('editGenre').value = book.genre;
        document.getElementById('editQuantity').value = book.quantity;

        editId = id;
        edBook.show();
    }

    editForm.addEventListener('submit', async e => {
        e.preventDefault();
        if (!editId) return;

        const title = document.getElementById('editTitle').value;
        const author = document.getElementById('editAuthor').value;
        const genre = document.getElementById('editGenre').value;
        const quantity = document.getElementById('editQuantity').value;

        const res = await fetch(`/books/${editId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ title, author, genre, quantity })
        });

        if (res.ok) {
            edBook.hide();
            loadBooks();
            editId = null;
        } else console.error("Failed to update book");
    });
});
