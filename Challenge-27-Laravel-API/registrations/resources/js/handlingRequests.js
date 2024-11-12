//redirection to dashboard after submitting the form and success or error message

$('#vehicleForm').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
        url: '/api/create-vehicle',
        method: 'POST',
        data: $(this).serialize(),
        success: function (response) {
            window.location.href = '/dashboard';
            alert(response.message);
        },
        error: function (err) {
            alert('An error occurred. Please try again.');
        }
    });
});

//loading vehicles on dashboard in table
function loadVehicles() {
    $.ajax({
        url: '/api/vehicles',
        method: 'GET',
        success: function (data) {
            $('#vehiclesTable tbody').empty();

            data.vehicles.forEach(vehicle => {
                $('#vehiclesTable tbody').append(`
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">${vehicle.id}</td>
                        <td class="px-6 py-4">${vehicle.brand}</td>
                        <td class="px-6 py-4">${vehicle.model}</td>
                        <td class="px-6 py-4">${vehicle.plate_number}</td>
                        <td class="px-6 py-4">${vehicle.insurance_date}</td>
                        <td class="px-3 py-4">
                        <button type="button" class="delete-btn text-white bg-gradient-to-r from-red-400 via-red-500
                        to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800
                        font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" data-id="${vehicle.id}">Delete</button>

                        <button type="button" class="edit-btn text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600
                        hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium
                        rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" data-id="${vehicle.id}">Edit</button>
                        </td>

                    </tr>
                `);
            });
        },
        error: function () {
            alert('Failed to load vehicles.');
        }
    });
}

//calling the function
loadVehicles();

//delete the chosen vehicle
$(document).on('click', '.delete-btn', function () {
    if (confirm('Are you sure you want to delete this vehicle?')) {
        let vehicleId = $(this).data('id');

        $.ajax({
            url: '/api/delete-vehicle/' + vehicleId,
            method: 'DELETE',
            success: function (response) {
                alert(response.message);
                loadVehicles();
            },
            error: function (err) {
                alert('An error occurred. Please try again.');
            }
        });
    }
});

//show edit form of chosen vehicle

$(document).on('click', '.edit-btn', function () {
    let vehicleId = $(this).data('id');

    window.location.href = `edit-vehicle/${vehicleId}`;
});

// when the form is submitted redirect back to dashboard
$('#vehicleEditForm').on('submit', function (e) {
    e.preventDefault();

    let vehicleId = $('#vehicle_id').val();

    $.ajax({
        url: '/api/update-vehicle/' + vehicleId,
        method: 'PATCH',
        data: $(this).serialize(),
        success: function (response) {
            alert(response.message);
            window.location.href = '/dashboard';
        },
        error: function (err) {
            alert('An error occurred while updating the vehicle.');
        }
    });
});


