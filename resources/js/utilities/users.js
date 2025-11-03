import './../bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formData');
    const modalElAdd = document.getElementById('addUserModal');
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const addUser = bootstrap.Modal.getOrCreateInstance(modalElAdd);

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
        } catch (error) {
            console.error("Error: ", error);
            return;
        }
    })
}) 
