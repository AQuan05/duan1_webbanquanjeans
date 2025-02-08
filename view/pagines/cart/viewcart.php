 <!-- Breadcrumb -->
 <?php require_once 'view/layout/header.php' ?>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
                                             <th>Id</th>
                                             <th>Product</th>
                                             <th class="text-center">Quantity</th>
                                             <th>Action</th>
                                         </tr>
                                     </thead>
                                     <?php if (! empty($cartItems)): ?>
                                         <?php foreach ($cartItems as $item): ?>
                                             <tr>
                                                 <td><?php echo htmlspecialchars($item['cart_item_id']); ?></td>
                                                 <td class="cr-cart-name">
                                                     <a href="javascript:void(0)">
                                                         <img src="admin/view/assets/images/products/<?php echo htmlspecialchars($item['img']); ?>"
                                                             alt="<?php echo htmlspecialchars($item['cart_name']); ?>"
                                                             class="cr-cart-img" width="50">
                                                         <?php echo htmlspecialchars($item['cart_name']); ?>
                                                     </a>
                                                 </td>

                                                 <td class="cr-cart-qty">
                                                     <div class="cart-qty-plus-minus">
                                                         <button type="button" class="minus" onclick="updateQuantity(<?php echo $item['cart_item_id']; ?>, -1)">−</button>
                                                         <input type="text" name="quantity" value="<?php echo htmlspecialchars($item['quantity']); ?>"
                                                             class="quantity" minlength="1" maxlength="20">
                                                         <button type="button" class="plus" onclick="updateQuantity(<?php echo $item['cart_item_id']; ?>, 1)">+</button>
                                                     </div>
                                                 </td>
                                                 <td class="cr-cart-remove">
                                                     <form action="?act=deletecart" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                                                         <input type="hidden" name="cart_item_id" value="<?php echo $item['cart_item_id']; ?>">
                                                         <button type="submit" style="border: none; background: none;">
                                                             <i class="fa fa-trash" style="color: red;"></i>
                                                         </button>
                                                     </form>
                                                 </td>
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