<?php 
include 'inc/header.php';
include_once'../classes/FAQ.php';
$faq= new FAQ();

?>
<?php 
if (!isset($_GET['viewid']) || $_GET['viewid']==NULL) {
   echo("<script>window.location='inbox.php';</script>");
   // header("Location: catlist.php");
}else{
    $viewid=$_GET['viewid'];
}
if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['lessonInfo'])) {
    $lesson->insertLessonInfo($_POST,$_FILES);
}

 ?>
        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content">

            <div data-push data-responsive-width="992px" class="mdk-drawer-layout js-mdk-drawer-layout">
                <div class="mdk-drawer-layout__content page ">

                    <div class="container-fluid page__container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="instructor-dashboard.html">Home</a></li>
                            <li class="breadcrumb-item active">Courses</li>
                        </ol>
                        <h1 class="h2">View Comment</h1>
                        <?php if(isset($_SESSION['error'])) {?>
                                      <div class="alert alert-warning alert-dismissible" data-auto-dismiss="2000" role="alert">
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          <strong style="color: red;">Warning!</strong>
                                           <?php echo($_SESSION['error']);

                                           unset($_SESSION['error']);
                                           ?>
                                      </div>
                                    <?php }?>
                                    <?php if(isset($_SESSION['success'])) {?>
                                    <div class="alert alert-success alert-dismissible" data-auto-dismiss="2000" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong style="color: green;">Success!</strong> 
                                        <?php echo($_SESSION['success']);

                                           unset($_SESSION['success']);
                                           ?>
                                      </div>
                                    <?php }?>
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <?php 
                                    $mgs=$faq->getSingleComment($viewid);
                                    if ($mgs) {
                                        while ($result=$mgs->fetch_assoc()) {
                                     ?>
                                    <div class="form-group row">
                                        <label for="title" class="col-md-3 col-form-label form-label">Subject</label>
                                        <div class="col-md-6">
                                            <input id="title" type="text" class="form-control" placeholder="Lesson title" name="title" value="<?php echo($result['subject']); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="title" class="col-md-3 col-form-label form-label">Description</label>
                                        <div class="col-md-9">
                                            <textarea id="mytextarea" name="content"><?php echo($result['body']); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-sm-9 offset-sm-3">
                                            <a href="replymsg.php?rmsgid=<?php echo($result['id']); ?>"  class="btn btn-success"><i class="material-icons">reply</i></a>
                                        </div>
                                    </div>
                                    <?php }} ?>
                                </form>
                            </div>
                        </div>
                        
                    </div>

                </div>
<?php include 'inc/sidebar.php';?>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php';?> 
