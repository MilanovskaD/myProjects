$(document).ready(function() {
    let isEditing = false;
    let editRow = null;
    let editExpenseAmount = 0;


    $('#budget-form').on('submit', function(event) {
        event.preventDefault();
        const budgetInput = $('#budget-input').val();


        if (budgetInput === '' || budgetInput <= 0) {
            $('.budget-feedback').text('Value cannot be empty or negative').show();
        } else {
            $('.budget-feedback').hide();
            const currentBudget = parseFloat($('#budget-amount').text());
            const newBudget = currentBudget + parseFloat(budgetInput);
            $('#budget-amount').text(newBudget);

            const currentExpenses = parseFloat($('#expense-amount').text());
            const newBalance = newBudget - currentExpenses;
            $('#balance-amount').text(newBalance);

            $('#budget-input').val('');
        }
    });


    $('#budget-input').on('focus', function() {
        $('.budget-feedback').hide();
    });


    $('#expense-form').on('submit', function(event) {
        event.preventDefault();
        const expenseTitle = $('#expense-input').val();
        const expenseAmount = $('#amount-input').val();


        if (expenseTitle === '' || expenseAmount === '' || expenseAmount <= 0) {
            $('.expense-feedback').text('Expense title and value cannot be empty or negative').show();
        } else {
            $('.expense-feedback').hide();

            if (isEditing) {

                updateExpenseRow(editRow, expenseTitle, expenseAmount);
                isEditing = false;
                editRow = null;
                editExpenseAmount = 0;
            } else {

                addExpenseRow(expenseTitle, expenseAmount);
            }


            const currentExpense = parseFloat($('#expense-amount').text());
            const newExpense = currentExpense - editExpenseAmount + parseFloat(expenseAmount);
            $('#expense-amount').text(newExpense);

            const currentBudget = parseFloat($('#budget-amount').text());
            const newBalance = currentBudget - newExpense;
            $('#balance-amount').text(newBalance);

s
            $('#expense-input').val('');
            $('#amount-input').val('');
        }
    });


    $('#expense-input, #amount-input').on('focus', function() {
        $('.expense-feedback').hide();
    });


    function addExpenseRow(title, amount) {
        if ($('#expense-table').length === 0) {

            $('#expense-table-container').append(`
                <table class="table mt-3" id="expense-table">
                    <thead>
                        <tr>
                            <th>Expense Title</th>
                            <th>Expense Value</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            `);
        }

        $('#expense-table tbody').append(`
            <tr>
                <td>${title}</td>
                <td>$${amount}</td>
                <td>
                    <button class="btn btn-info btn-sm edit-expense"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm delete-expense"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        `);
    }


    function updateExpenseRow(row, title, amount) {
        row.find('td:nth-child(1)').text(title);
        row.find('td:nth-child(2)').text(`$${amount}`);
        $('#expense-table tbody').append(row);
    }

    // Handle expense deletion
    $(document).on('click', '.delete-expense', function() {
        const row = $(this).closest('tr');
        const expenseAmount = parseFloat(row.find('td:nth-child(2)').text().substring(1));
        row.remove();


        const currentExpense = parseFloat($('#expense-amount').text());
        const newExpense = currentExpense - expenseAmount;
        $('#expense-amount').text(newExpense);

        const currentBalance = parseFloat($('#balance-amount').text());
        const newBalance = currentBalance + expenseAmount;
        $('#balance-amount').text(newBalance);
    });


    $(document).on('click', '.edit-expense', function() {
        const row = $(this).closest('tr');
        const expenseTitle = row.find('td:nth-child(1)').text();
        const expenseAmount = parseFloat(row.find('td:nth-child(2)').text().substring(1));


        $('#expense-input').val(expenseTitle);
        $('#amount-input').val(expenseAmount);


        row.remove();


        const currentExpense = parseFloat($('#expense-amount').text());
        const newExpense = currentExpense - expenseAmount;
        $('#expense-amount').text(newExpense);

        const currentBalance = parseFloat($('#balance-amount').text());
        const newBalance = currentBalance + expenseAmount;
        $('#balance-amount').text(newBalance);


        isEditing = true;
        editRow = row;
        editExpenseAmount = expenseAmount;
    });
});
