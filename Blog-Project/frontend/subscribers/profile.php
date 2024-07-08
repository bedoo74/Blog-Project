<?php
require_once("header.php");

// التحقق من جلسة المستخدم
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = unserialize($_SESSION['user']);
$myposts = $user->my_posts($user->id);
?>

<section class="w-100 px-4 py-5" style="background-color: #9de2ff; border-radius: .5rem .5rem 0 0;">
    <div class="row d-flex justify-content-center">
        <div class="col col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Profile Picture</div>
                                <div class="card-body text-center">
                                    <?php if (isset($_GET["msg"]) && $_GET["msg"] == 'uius') : ?>
                                        <div class="alert alert-success" role="alert">
                                            <strong>Done</strong> User Image Updated Successfully
                                        </div>
                                    <?php endif; ?>
                                    <!-- Profile picture image-->
                                    <img class="img-account-profile rounded-circle mb-2" style="width: 150px; height:150px; border-radius:150px" src="<?= !empty($user->image) ? htmlspecialchars($user->image) : 'http://bootdey.com/img/Content/avatar/avatar1.png'; ?>" alt="Profile Picture">
                                    <!-- Profile picture help block-->
                                    
                                    <!-- Profile picture upload button-->
                                    <form action="store_user_image.php" method="POST" enctype="multipart/form-data">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" name="image" id="image" class="form-control" />
                                        <button type="submit" class="btn btn-success mt-2">Upload</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1"><?= htmlspecialchars($user->name) ?></h5>
                            <p class="mb-2 pb-1"><?= htmlspecialchars($user->role) ?></p>
                            <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary">
                               
                                <div class="px-3">
                                    <p class="small text-muted mb-1">Followers</p>
                                    <p class="mb-0">976</p>
                                </div>
                                <div>
                                    <p class="small text-muted mb-1">following</p>
                                    <p class="mb-0">85</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3 mt-5 rounded-2">
            <h1 class="text-white text-center">Share Your Idea</h1>
        </div>
        <form action="storePost.php" method="POST" enctype="multipart/form-data">
            <div class="col-6 offset-3 mt-5 rounded-2">
                <?php if (isset($_GET["msg"])) : ?>
                    <?php if ($_GET["msg"] == 'done') : ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Done</strong> Post Added Successfully
                        </div>
                    <?php elseif ($_GET["msg"] == 'require_fields') : ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Require Fields</strong> Fields Are Empty
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="" aria-describedby="titleHelp" />
                    <small id="titleHelp" class="text-muted">Help text</small>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" id="content" class="form-control" placeholder="" aria-describedby="contentHelp" style="resize:none;"></textarea>
                    <small id="contentHelp" class="text-muted">Help text</small>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="image" class="form-control" placeholder="" aria-describedby="imageHelp" />
                    <small id="imageHelp" class="text-muted">Help text</small>
                </div>
                <button type="submit" class="btn btn-primary my-5">Submit</button>
            </div>
        </form>
        <div class="col-6 offset-3 mt-5 rounded-2">
            <?php foreach ($myposts as $post) : ?>
                <div class="card mt-5">
                    <?php if (!empty($post['image'])) : ?>
                        <img class="card-img-top" src="<?= htmlspecialchars($post['image']) ?>" alt="Post Image">
                    <?php endif; ?>
                    <div class="card-body">
                        <h4 class="card-title"><?= htmlspecialchars($post['title']) ?></h4>
                        <p class="card-text"><?= htmlspecialchars($post['content']) ?></p>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <div class="card shadow-0 border">
                                <div class="card-body p-4">
                                    <form action="store_comment.php" method="POST">
                                        <div class="form-outline mb-4">
                                            <input type="text" id="addANote" name="comment" class="form-control" placeholder="Type comment..." />
                                            <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['id']) ?>">
                                            <button type="submit" class="btn btn-primary mt-2 ms-2">+ Add a note</button>
                                        </div>
                                    </form>
                                    <?php
                                    $comments = $user->get_post_comment($post['id']);
                                    foreach ($comments as $comment) :
                                    ?>
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <p><?= htmlspecialchars($comment['comment']) ?></p>
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <img src="<?= !empty($comment['image']) ? htmlspecialchars($comment['image']) : 'http://bootdey.com/img/Content/avatar/avatar1.png'; ?>" alt="avatar" width="25" height="25" />
                                                        <p class="small mb-0 ms-2"><?= htmlspecialchars($comment['name']) ?></p>
                                                    </div>
                                                    <div class="d-flex flex-row align-items-center">
                                                        <p class="small text-muted mb-0"><?= htmlspecialchars($comment['created_at']) ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
require_once("footer.php");
?>
