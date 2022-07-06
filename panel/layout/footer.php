
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>فارسی سازی شده و پویا سازی توسط <a href="https://github.com/meysamWeb/" target="_blank">meysamWeb</a></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">آیا میخواهید خارج شوید؟</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">اگر میخواهید از صفحه مدیریت خارج شوید روی دکمه "خروج" کلیک کنید</div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">انصراف</button>
                <a class="btn btn-outline-danger" href="<?= url('auth/logout.php') ?>">خروج</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= assets('assets/js/bootstrap/jquery.min.js') ?>"></script>
<script src="<?= assets('assets/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= assets('assets/js/jquery.easing.min.js') ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= assets('assets/js/admin-panel.min.js') ?>"></script>

<!-- Page level plugins -->
<script src="<?= assets('assets/js/Chart.min.js') ?>"></script>