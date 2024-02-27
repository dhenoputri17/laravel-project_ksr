<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <?php if(auth()->check() && auth()->user()->role == 'admin'): ?>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="<?php echo e(url('/dashboard')); ?>" aria-expanded="false"><i
                                class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="<?php echo e(url('/meja')); ?>" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span
                                class="hide-menu">Meja</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="<?php echo e(url('/produk')); ?>" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span
                                class="hide-menu">Produk</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="<?php echo e(url('/kategori')); ?>" aria-expanded="false"><i class="mdi mdi-collage"></i><span
                                class="hide-menu">Kategori</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="<?php echo e(url('/transaksi')); ?>" aria-expanded="false"><i
                                class="mdi mdi-chart-bubble"></i><span class="hide-menu">Transaksi</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="<?php echo e(url('/kasirr')); ?>" aria-expanded="false"><i class="mdi mdi-face"></i><span
                                class="hide-menu">Kasir</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                            href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span
                                class="hide-menu">Laporan</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="<?php echo e(url('/laporan-stok_barang')); ?>" target="_blank" onclick="window.open('<?php echo e(url('/laporan-stok_barang')); ?>', '_blank'); return false;"
                                class="sidebar-link"><i class="mdi mdi-note-outline"></i>
                                <span class="hide-menu"> Laporan Stok Barang </span></a>
                            </li>
                            <li class="sidebar-item"><a href="<?php echo e(url('/laporan-penjualan_barang')); ?>" target="_blank" onclick="window.open('<?php echo e(url('/laporan-penjualan_barang')); ?>', '_blank'); return false;" class="sidebar-link"><i
                                        class="mdi mdi-note-plus"></i><span class="hide-menu"> Laporan Penjualan Barang </span></a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<?php /**PATH C:\xampp\htdocs\projeksaya\resources\views/layouts/component/sidebar.blade.php ENDPATH**/ ?>