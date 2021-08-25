<?php include('./comment.php') ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment Section</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="container-fluid bg-white py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card border-0 shadow-md bg-body rounded p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <h5>Users Comments</h5>
                        </div>
                        <div class="card-body">
                            <form action="comment.php" method="POST">
                                <div class="form-floating mb-3 fs-6">
                                    <input type="email" class="form-control shadow-none" id="email" name="email" placeholder="name@example.com">
                                    <label for="email">Email address</label>
                                </div>
                                <div class="mb-4 fs-6">
                                    <label for="comment" class="mb-2">Comment</label>
                                    <textarea class="form-control shadow-none" id="comment" name="comment" rows="5" placeholder="Type here"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg fs-6 shadow-sm rounded">Submit</button>
                            </form>
                        </div>
                        <div class="card-body">
                            <?php if ($comments->num_rows <= 0) : ?>
                                <small class="text-muted">No comments</small>
                            <?php else : ?>
                                <?php foreach ($comments as $comment) : ?>
                                    <div class="list-group mb-3">
                                        <div class="list-group-item">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <img src="https://www.pphfoundation.ca/wp-content/uploads/2018/05/default-avatar.png" alt="Avatar" width="50" height="50" class="rounded-circle shadow-sm">
                                                </div>
                                                <div>
                                                    <strong class="d-block"><?php echo $comment['email'] ?></strong>
                                                    <span><?php echo $comment['comment'] ?></span>
                                                </div>
                                                <div class="ms-auto">
                                                    <small><?php echo time_elapsed_string($comment['created_at']) ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>