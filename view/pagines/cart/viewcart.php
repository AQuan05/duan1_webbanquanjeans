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
                                             <th>Variants</th>
                                             <th class="text-center">Quantity</th>
                                             <th>Total</th>
                                             <th>Action</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <tr>
                                             <td class="cr-cart-name">
                                                 <a href="javascript:void(0)">
                                                     <img src="view/assets/img/product/1.jpg" alt="product-1"
                                                         class="cr-cart-img">
                                                     Organic Lemon
                                                 </a>
                                             </td>
                                             <td class="cr-cart-price">
                                                 <span class="amount">$56.00</span>
                                             </td>
                                             <td class="cr-cart-variants">
                                                 <span>Yellow,XXL</span>
                                             </td>
                                             <td class="cr-cart-qty">
                                                 <div class="cart-qty-plus-minus">
                                                     <button type="button" class="plus">+</button>
                                                     <input type="text" placeholder="." value="1" minlength="1"
                                                         maxlength="20" class="quantity">
                                                     <button type="button" class="minus">-</button>
                                                 </div>
                                             </td>
                                             <td class="cr-cart-subtotal">$56.00</td>
                                             <td class="cr-cart-remove">
                                                 <a href="javascript:void(0)">
                                                     <i class="ri-delete-bin-line"></i>
                                                 </a>
                                             </td>
                                         </tr>
                                     </tbody>
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