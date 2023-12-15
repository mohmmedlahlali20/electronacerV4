
     $(document).ready(function() {
        $('table').DataTable();

        showAllUsers();
        function showAllUsers() {
            $.ajax({
                url: 'index.php',
                type: "POST",
                url: "showAllUsers",
                dataType: {action:"view"},
                success: function(reponse) {
                    
                    console.log(reponse);
                }
            });

        }
    });