<!DOCTYPE html>
<html>
    <head>  
        <meta charset="utf-8">
        <title>Dolphin CRM</title>
        <link href = "styles.css" type="text/css" rel="stylesheet"/>

        <script src="script.js" type = "text/javascirpt"></script>
    </head>
    <body>
        <header>
            <h1>Dolphin CRM</h1>
        </header>
        <div class="contact-details-container">
            <h2>Contact Details</h2>

<!-- Display contact details here -->
<div id="contact-details">
    <!-- PHP will display dynamic contact info here -->
</div>

<h3>Notes</h3>
<div id="notes-list">
    <!-- PHP will display notes dynamically here -->
</div>

<form id="add-note-form">
    <textarea id="note_content" name="note_content" required></textarea>
    <button type="submit">Add Note</button>
</form>

<script>
// AJAX to handle adding a note
$('#add-note-form').on('submit', function(e) {
    e.preventDefault();
    var noteContent = $('#note_content').val();
    var contactId = <?php echo $contact_id; ?>;

    $.ajax({
        url: 'add_note.php',
        type: 'POST',
        data: {
            contact_id: contactId,
            note_content: noteContent
        },
        success: function(response) {
            if (response.status == 'success') {
                $('#notes-list').append('<p>' + response.user_name + ': ' + response.note_content + ' <small>(' + response.created_at + ')</small></p>');
                $('#note_content').val('');
            } else {
                alert('Error: ' + response.message);
            }
        }
    });
});
</script>
        </div>


        <footer>
            <p>Copyright &copy; 2024, Dolphin CFM</p>
        </footer>

    </body>
</html>