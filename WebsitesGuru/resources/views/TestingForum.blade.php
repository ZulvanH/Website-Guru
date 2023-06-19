<!DOCTYPE html>
<html>
<head>
    <title>Discussion Forum</title>
    <link rel="stylesheet" type="text/css" href="forum.css">
</head>
<body>
    <div class="container">
        <h1>Discussion Forum</h1>
        <div class="forum">
            <div class="topic">
                <div class="topic-header">
                    <h2>Topic Title</h2>
                    <p>Posted by User on 15 June 2023</p>
                </div>
                <div class="topic-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer gravida mi a felis ullamcorper viverra. Etiam maximus magna eu ligula fringilla rhoncus. In eget purus rhoncus, fermentum lacus in, iaculis massa.</p>
                </div>
                <div class="topic-footer">
                    <a href="#">Reply</a>
                    <a href="#">Report</a>
                </div>
            </div>
            <div class="topic">
                <div class="topic-header">
                    <h2>Topic Title</h2>
                    <p>Posted by User on 14 June 2023</p>
                </div>
                <div class="topic-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer gravida mi a felis ullamcorper viverra. Etiam maximus magna eu ligula fringilla rhoncus. In eget purus rhoncus, fermentum lacus in, iaculis massa.</p>
                </div>
                <div class="topic-footer">
                    <a href="#">Reply</a>
                    <a href="#">Report</a>
                </div>
            </div>
        </div>
    </div>
    <div class="comments">
        <h2>Comments</h2>
        <div class="comment">
            <div class="comment-header">
                <p>Posted by User on 16 June 2023</p>
            </div>
            <div class="comment-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed condimentum lorem a lectus vulputate placerat.</p>
            </div>
        </div>
        <div class="comment">
            <div class="comment-header">
                <p>Posted by User on 15 June 2023</p>
            </div>
            <div class="comment-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed condimentum lorem a lectus vulputate placerat.</p>
            </div>
        </div>
        <!-- Add more comment elements here -->
    </div>

    <div class="new-comment">
        <h2>Add a Comment</h2>
        <form>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
