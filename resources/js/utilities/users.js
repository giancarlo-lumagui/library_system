import './../bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formData');
    const delForm = document.getElementById('delForm');
    const editForm = document.getElementById('editForm');
    const table = document.getElementById('userList');
    const modalElAdd = document.getElementById('addUserModal');
    const modalElDel = document.getElementById('deleteUserModal');
    const modalElEdit = document.getElementById('editUserModal');
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const addUser = bootstrap.Modal.getOrCreateInstance(modalElAdd);
    const delUser = bootstrap.Modal.getOrCreateInstance(modalElDel);
    const edUser = bootstrap.Modal.getOrCreateInstance(modalElEdit);

    let deleteId = null;
    let editId = null;
    let currentUsers = []; 

    loadUsers();

 
    table.addEventListener('click', e => {
        const row = e.target.closest('tr');
        if (!row) return;
        const id = row.dataset.id;

        if (e.target.closest('.delete-btn')) {
            deleteUser(id);
        }

        if (e.target.closest('.edit-btn')) {
            editUser(id);
        }
    });

    form.addEventListener('submit', async e => {
        try {
            e.preventDefault();

            const name = document.getElementById('name').value;
            const password = document.getElementById('password').value;
            const role = document.getElementById('role').value;

            const response = await fetch('/users/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ name, password, role })
            });

            if (!response.ok) {
                console.error("Failed to add user");
                return;
            }
            console.log('success')
            addUser.hide();
            form.reset();
            loadUsers(); // Reload users after adding
        } catch (error) {
            console.error("Error: ", error);
            return;
        }
    })

    async function loadUsers() {
        try {
            const res = await fetch('/users/show');
            const data = await res.json();

            if (!data.success || !data.users.length) {
                table.innerHTML = '<tr> <td colspan="3" class="text-center"> No user found </td> </tr>';
                currentUsers = [];
                return;
            }

            // Store users for later access in edit function
            currentUsers = data.users;

            table.innerHTML = data.users.map(user => `
            <tr data-id="${user.id}">
                <td> ${user.name} </td>
                <td> ${user.role} </td>
                <td> 
                    <button class="btn btn-outline-warning edit-btn"> 
                        <bi class="bi bi-eye"></bi>
                    </button>
                    <button class="btn btn-outline-danger delete-btn"> 
                        <bi class="bi bi-trash"></bi>
                    </button>
                </td>
            </tr>
            `).join('');
        } catch (error) {
            console.error("Error: ", error);
            return;
        }
    }

    // for deleting
    function deleteUser(id) {
        deleteId = id;
        delUser.show();
    }

    delForm.addEventListener('submit', async e => {
        try {
            e.preventDefault();
            if (!deleteId) return;
            const response = await fetch(`/users/${deleteId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                }
            });

            if (response.ok) {
                delUser.hide();
                loadUsers();
                deleteId = null; // Reset deleteId
            } else {
                console.error("Failed to delete user");
            }
        } catch (error) {
            console.error("Error: ", error);
        }
    });

    // for editing
    function editUser(id) {
        // Find the user in the stored users array
        const user = currentUsers.find(u => u.id == id);
        if (!user) {
            console.error("User not found");
            return;
        }

        document.getElementById('editName').value = user.name;
        document.getElementById('editRole').value = user.role;
        
        editId = id;
        edUser.show();
    }

    editForm.addEventListener('submit', async e => {
        try {
            if (!editId) return;
            e.preventDefault();

            const editName = document.getElementById('editName').value;
            const editRole = document.getElementById('editRole').value;

            const response = await fetch(`/users/${editId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ 
                    name: editName, 
                    role: editRole 
                })
            });

            if (!response.ok) {
                console.error("Failed to update user");
                return;
            }

            edUser.hide();
            loadUsers();
            editId = null;
        } catch (error) {
            console.error("Error: ", error);
            return;
        }
    });
});