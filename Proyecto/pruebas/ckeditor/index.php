<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CKEditor 5 – Classic editor</title>
        <script src="https://cdn.ckeditor.com/ckeditor5/22.0.0/classic/ckeditor.js"></script>
 
    </head>
    <body>
        <?php
        if (isset($_POST['content'])) {
            $editor_data = $_POST['content'];
 
            // Create connection
            $conn = new mysqli("localhost", "root", "admin", "tecnoticos");
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
 
            $sql = "INSERT INTO editor (content) VALUES ('$editor_data')";
 
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
 
            $conn->close();
        }
        ?>
 
        <h2>CKEditor 5 Example with PHP</h2>
        <form action="" method="post">
            <textarea name="content" id="editor">
                     
       
           
            <p>Modern JavaScript rich text editor with a modular architecture. Its clean UI and features provide the perfect WYSIWYG UX ❤️ for creating semantic content.</p>
            <ul>
                <li>Written in ES6 with MVC architecture, custom data model, virtual DOM.</li>
                <li>Responsive images and media embeds (videos, tweets).</li>
                <li>Custom output format: HTML and Markdown support.</li>
                <li>Boost productivity with auto-formatting and collaboration.</li>
                <li>Extensible and customizable by design.</li>
            </ul>
            <blockquote><h2>Rich text editor of tomorrow, available today. </h2></blockquote>
            <a href="">Learn More</a>
            </textarea>
            <p><input type="submit" value="Submit"></p>
        </form>
        <script>
            ClassicEditor
                    .create(document.querySelector('#editor'))
                    .catch(error => {
                        console.error(error);
                    });
        </script>
    </body>
</html>