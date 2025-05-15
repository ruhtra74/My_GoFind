<?php
    session_start();
    session_destroy ();
    
    echo "
        <script>
            alert('A la prochiane. 👋');
            window.location.href='../index.html';
        </script>
    ";

?>