<?php

    if(file_exists('json/todo.json')){
        $json = file_get_contents('json/todo.json');
        $todos = json_decode($json, true);
    }

?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport">

        <title style="font-size: 100px;"> To do list </title>
    </head>

    <body>

        <div class="list">
            <h1 class="header"> To do. </h1>
            
            <form action="app/add.php" method="POST">
                
                <input type="text" name="todo_name" placeholder="Type new item here.">
                <button> New Todo </button>

            </form>
            
            <?php 
                foreach ($todos as $todoName => $todo) { ?>
                    <div style="margin-bottom: 20px;">
                        
                        <form style="display: inline-block;" action="app/status.php" method="POST">
                            <input type="hidden" name="todo_name" value="<?php echo $todoName ?>">                        
                            <input type="checkbox" <?php echo $todo['completed'] ? 'checked' : '' ?>>
                        </form>
                        
                        <?php echo " TODO : $todoName "; ?> 
                            <form style="display: inline-block" action="app/delete.php" method="POST">
                                <input type="hidden" name="todo_name" value="<?php echo $todoName ?>">
                                <button> Delete </button>
                            </form>
                    </div>
            <?php }; ?>

            <script>
                const checkbox = document.querySelectorAll('input[type=checkbox]');
                checkbox.forEach(ch => {
                    ch.onclick = function(){
                        this.parentNode.submit();
                    };
                })
            </script>
              
        </div>
    </body>
</html>