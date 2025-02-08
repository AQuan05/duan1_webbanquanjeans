 <!-- Breadcrumb -->
 <?php require_once 'view/layout/header.php' ?>
 <section class="section-breadcrumb">
     <div class="cr-breadcrumb-image">
         <div class="container">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="cr-breadcrumb-title">
                         <h2>Cart</h2>
                         <span> <a href="index.php">Home</a> / Cart</span>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- Cart -->
 <section class="section-cart padding-t-100">
     <div class="container">
         <div class="row d-none">
             <div class="col-lg-12">
                 <div class="mb-30" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                     <div class="cr-banner">
                         <h2>Cart</h2>
                     </div>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-12">
                 <div class="cr-cart-content" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400">
                     <div class="row">
                         <form action="#">
                             <div class="cr-table-content">
                                 <table>
                                     <thead>
                                         <tr>
                                             <th>Product</th>
                                             <th>price</th>
                                             <th class="text-center">Quantity</th>
                                             <th>Total</th>
                                             <th>Action</th>
                                         </tr>
                                     </thead>
                                     <?php if (! empty($cartItems)): ?>
                                         <?php foreach ($cartItems as $item): ?>
                                             <tr>
                                                 <td><?php echo htmlspecialchars($item['cart_id']); ?></td>
                                                 <td><?php echo htmlspecialchars($item['cart_name']); ?></td>
                                                 <td>
                                                     <img src="admin/view/assets/images/products/<?php echo htmlspecialchars($item['image']); ?>"
                                                         alt="<?php echo htmlspecialchars($item['cart_name']); ?>"
                                                         width="50">
                                                 </td>
                                                 <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                                             </tr>
                                         <?php endforeach; ?>
                                     <?php else: ?>
                                         <tr>
                                             <td colspan="4" style="text-align: center;">Giỏ hàng của bạn đang trống.</td>
                                         </tr>
                                     <?php endif; ?>
                                 </table>
                             </div>
                             <div class="row">
                                 <div class="col-lg-12">
                                     <div class="cr-cart-update-bottom">
                                         <a href="javascript:void(0)" class="cr-links">Continue Shopping</a>
                                         <a href="cart.html" class="cr-button">
                                             Check Out
                                         </a>
                                     </div>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <?php require_once 'view/layout/footer.php' ?>