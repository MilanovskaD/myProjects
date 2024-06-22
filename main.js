
$(document).ready(function () {
    // Add note with AJAX request
    $('#add-note').click(function(e) {
        e.preventDefault();
        const noteContent = $('#notes-content').val();
        const bookId = $(this).data('book-id');
        const userId = $(this).data('user-id');

        $.ajax({
            url: 'add-note.php',
            method: 'POST',
            data: {
                note_content: noteContent,
                book_id: bookId,
                user_id: userId
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#notes-content').val('');
                    loadNotes();
                } else {
                    $('#notes').html(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    // Load notes with AJAX
    const bookId = $('#add-note').data('book-id');
    const userId = $('#add-note').data('user-id');

    function loadNotes() {
        $.ajax({
            url: 'get-notes.php',
            method: 'POST',
            data: { book_id: bookId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    let notesHtml = '';
                    response.notes.forEach(note => {
                        notesHtml += `
                            <div class="note" data-note-id="${note.id}">
                                <p class="note-content">${note.note_content}</p>
                                <div class="note-buttons">
                                    <button class="btn btn-link p-0 m-0 align-baseline delete-note" title="Delete Note">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                    <button class="btn btn-link p-0 m-0 align-baseline edit-note" title="Edit Note" data-note-id="${note.id}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                    });
                    $('#notes').html(notesHtml);
                    attachNoteEventHandlers();
                } else {
                    console.error('Error loading notes:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    }

    function attachNoteEventHandlers() {
        $('.delete-note').off('click').on('click', function() {
            const noteId = $(this).closest('.note').data('note-id');
            deleteNote(noteId);
        });

        $('.edit-note').off('click').on('click', function() {
            const noteId = $(this).data('note-id');
            const noteContent = $(this).closest('.note').find('.note-content').text();
            $('#notes-content').val(noteContent).focus();
            $('#add-note').text('Update').data('edit-note-id', noteId);
        });
    }

    function deleteNote(noteId) {
        $.ajax({
            url: 'delete-note.php',
            method: 'POST',
            data: { note_id: noteId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    loadNotes();
                } else {
                    console.error('Error deleting note:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    }

    $('#add-note').off('click').on('click', function(e) {
        e.preventDefault();
        const noteContent = $('#notes-content').val();
        const noteId = $(this).data('edit-note-id');

        if (noteId) {
            updateNote(noteId, noteContent);
        } else {
            addNote();
        }
    });

    function addNote() {
        const noteContent = $('#notes-content').val();

        $.ajax({
            url: 'add-note.php',
            method: 'POST',
            data: {
                note_content: noteContent,
                book_id: bookId,
                user_id: userId
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#notes-content').val('');
                    $('#add-note').text('Add').removeData('edit-note-id');
                    loadNotes();
                } else {
                    console.error('Error adding note:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    }

    function updateNote(noteId, noteContent) {
        $.ajax({
            url: 'update-note.php',
            method: 'POST',
            data: {
                note_id: noteId,
                note_content: noteContent
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#notes-content').val('');
                    $('#add-note').text('Add').removeData('edit-note-id');
                    loadNotes();
                } else {
                    console.error('Error updating note:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    }

    loadNotes();
});

// Handle comment editing
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('.edit-comment').forEach(button => {
        button.addEventListener('click', function() {
            const commentId = this.getAttribute('data-comment-id');
            const commentContent = this.closest('.comment').querySelector('.comment-content').innerText;

            document.getElementById('comments').value = commentContent;
            document.getElementById('comment_id').value = commentId;

            const commentForm = document.getElementById('commentForm');
            commentForm.action = './update-comment.php';
            document.querySelector('#commentForm button[type="submit"]').textContent = 'Update';
        });
    });
});

// Confirm delete with SweetAlert
function confirmDelete(bookId) {
    Swal.fire({
        title: "Are you sure you want to delete this book?",
        text: "You won't be able to revert this",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete"
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = './delete-book.php';

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'id';
            input.value = bookId;
            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
        }
    });
}

// Managing comments tables
document.addEventListener("DOMContentLoaded", function() {
    const approvedCommentsTable = document.getElementById("approved-comments");
    const pendingCommentsTable = document.getElementById("pending-comments");
    const switchBtn = document.getElementById("switchTables");
    const switchBackTables = document.getElementById("switchTablesBack");

    if (localStorage.getItem("showApprovedComments") === "true") {
        pendingCommentsTable.style.display = "none";
        approvedCommentsTable.style.display = "block";
        switchBtn.style.display = "none";
        switchBackTables.style.display = "block";
    } else {
        approvedCommentsTable.style.display = "none";
        switchBackTables.style.display = "none";
    }

    switchBtn.onclick = (event) => {
        event.preventDefault();
        pendingCommentsTable.style.display = "none";
        approvedCommentsTable.style.display = "block";
        switchBtn.style.display = "none";
        switchBackTables.style.display = "block";
        localStorage.setItem("showApprovedComments", "true");
    };

    switchBackTables.onclick = (event) => {
        event.preventDefault();
        pendingCommentsTable.style.display = "block";
        approvedCommentsTable.style.display = "none";
        switchBtn.style.display = "block";
        switchBackTables.style.display = "none";
        localStorage.setItem("showApprovedComments", "false");
    };
});

// Books/cards filtering
document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('.checkbox-wrapper input[type="checkbox"]');
    const cards = document.querySelectorAll('.cards-container .card');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const checkedCategories = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.name.toLowerCase());

            cards.forEach(card => {
                const cardCategory = card.classList[1].toLowerCase();
                if (checkedCategories.length === 0 || checkedCategories.includes(cardCategory)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});

// Fetch and display random quote
fetch('https://api.quotable.io/random')
    .then(response => response.json())
    .then(data => {
        const randomQuote = document.getElementById('quote');
        randomQuote.innerHTML = `${data.content} ${data.author}`;
    })
    .catch(error => console.error('Error fetching quote:', error));

// Handle modals for signup and login forms
document.addEventListener('DOMContentLoaded', () => {
    const signupModal = document.getElementById("signupModal");
    const loginModal = document.getElementById("loginModal");
    const signupBtn = document.getElementById("signupBtn");
    const loginBtn = document.getElementById("loginBtn");
    const closeSignup = document.getElementById("closeSignup");
    const closeLogin = document.getElementById("closeLogin");

    signupBtn.onclick = () => {
        signupModal.style.display = "block";
    };
    loginBtn.onclick = () => {
        loginModal.style.display = "block";
    };

    closeSignup.onclick = () => {
        signupModal.style.display = "none";
    };
    closeLogin.onclick = () => {
        loginModal.style.display = "none";
    };

    if (document.getElementById("signupError")) {
        document.getElementById("signupModal").style.display = "block";
    }
});

// Animation for 3D book view
document.addEventListener('DOMContentLoaded', () => {
    const book = document.querySelector('.book');
    book.addEventListener('mouseenter', function() {
        this.style.transform = 'rotateY(-30deg)';
    });

    book.addEventListener('mouseleave', function() {
        this.style.transform = 'rotateY(0deg)';
    });
});

// Toggle password visibility
function showPassword() {
    const pswShow = document.querySelectorAll('.showPassword');
    pswShow.forEach(input => {
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    });
}