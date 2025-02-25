<!-- JAVASCRIPT -->
<script src="../admin/view/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../admin/view/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../admin/view/assets/libs/node-waves/waves.min.js"></script>
    <script src="../admin/view/assets/libs/feather-icons/feather.min.js"></script>
    <script src="../admin/view/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="../admin/view/assets/js/plugins.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <!-- Vector map-->
    <script src="../admin/view/assets/libs/jsvectormap/jsvectormap.min.js"></script>
    <script src="../admin/view/assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!--Swiper slider js-->
    <script src="../admin/view/assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- Dashboard init -->
    <script src="../admin/view/assets/js/pages/dashboard-ecommerce.init.js"></script>

    <!-- App js -->
    <script src="../admin/view/assets/js/app.js"></script>  
    <script>
    document.getElementById('add-variant-btn').addEventListener('click', function () {
    // Lấy container gốc
    const container = document.getElementById('variant-container');
    
    // Tạo một bản sao của phần tử nhóm biến thể đầu tiên
    const firstVariantGroup = container.querySelector('.variant-group');
    const newVariantGroup = firstVariantGroup.cloneNode(true);

    // Xóa các giá trị được chọn trong bản sao
    newVariantGroup.querySelectorAll('select').forEach(select => {
        select.selectedIndex = 0; // Reset về lựa chọn mặc định
    });

    // Thêm bản sao vào container
    container.appendChild(newVariantGroup);
});
</script>