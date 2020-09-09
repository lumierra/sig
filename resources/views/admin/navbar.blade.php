<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item {{ Request::path() === 'admin/dashboard' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>


<!-- Nav Item - Pages Collapse Menu -->
@if(Request::path() == 'admin/dashboard')
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master
    </div>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.management-user.index') }}">Pengguna</a>
                <a class="collapse-item" href="{{ route('admin.kepala-gizi.index') }}">Penanggung Jawab</a>
                <hr class="divider">
                <a class="collapse-item" href="{{ route('admin.kategori.index') }}">Kategori Bhn Mkn</a>
                <a class="collapse-item" href="{{ route('admin.bahan-makanan.index') }}">Bahan Makanan</a>
                <a class="collapse-item" href="{{ route('admin.jenis-makanan.index') }}">Jenis Makanan</a>
                <a class="collapse-item" href="{{ route('admin.makanan.index') }}">Menu Makanan</a>
                <a class="collapse-item" href="{{ route('admin.detail-makanan.index') }}">Detail Bahan Makanan</a>
                <hr class="divider">
                <a class="collapse-item" href="{{ route('admin.satuan-makanan.index') }}">Satuan Makanan</a>
                <a class="collapse-item" href="{{ route('admin.vendor.index') }}">Vendor</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-shopping-cart "></i>
            <span>Transaksi</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Transaksi</h6>
                <a class="collapse-item {{ Request::path() === 'admin/permintaan' ? 'active' : '' }}" href="{{ route('admin.permintaan.index') }}">Permintaan</a>
                <a class="collapse-item {{ Request::path() === 'admin/penerimaan' ? 'active' : '' }}" href="{{ route('admin.penerimaan.index') }}">Penerimaan</a>
                <a class="collapse-item {{ Request::path() === 'admin/pengeluaran' ? 'active' : '' }}" href="{{ route('admin.pengeluaran.index') }}">Pengeluaran</a>
                <a class="collapse-item {{ Request::path() === 'admin/retur' ? 'active' : '' }}" href="{{ route('admin.retur.index') }}">Pengembalian</a>
                <a class="collapse-item {{ Request::path() === 'admin/stok-bahan' ? 'active' : '' }}" href="{{ route('admin.stok-bahan.index') }}">Stok Bahan</a>
            </div>
        </div>
    </li>
@elseif(Request::path() == 'admin/permintaan' || Request::path() == 'admin/penerimaan' || Request::path() == 'admin/pengeluaran' || Request::path() == 'admin/retur' || Request::path() == 'admin/stok-bahan')
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master
    </div>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::path() === 'admin/management-user' ? 'active' : '' }}" href="{{ route('admin.management-user.index') }}">Pengguna</a>
                <a class="collapse-item {{ Request::path() === 'admin/kepala-gizi' ? 'active' : '' }}" href="{{ route('admin.kepala-gizi.index') }}">Penanggung Jawab</a>
                <hr class="divider">
                <a class="collapse-item {{ Request::path() === 'admin/kategori' ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}">Kategori Bhn Mkn</a>
                <a class="collapse-item {{ Request::path() === 'admin/bahan-makanan' ? 'active' : '' }}"  href="{{ route('admin.bahan-makanan.index') }}">Bahan Makanan</a>
                <a class="collapse-item {{ Request::path() === 'admin/jenis-makanan' ? 'active' : '' }}" href="{{ route('admin.jenis-makanan.index') }}">Jenis Makanan</a>
                <a class="collapse-item {{ Request::path() === 'admin/makanan' ? 'active' : '' }}" href="{{ route('admin.makanan.index') }}">Menu Makanan</a>
                <a class="collapse-item {{ Request::path() === 'admin/detail-makanan' ? 'active' : '' }}" href="{{ route('admin.detail-makanan.index') }}">Detail Bahan Makanan</a>
                <hr class="divider">
                <a class="collapse-item {{ Request::path() === 'admin/satuan-makanan' ? 'active' : '' }}" href="{{ route('admin.satuan-makanan.index') }}">Satuan Makanan</a>
                <a class="collapse-item {{ Request::path() === 'admin/vendor' ? 'active' : '' }}" href="{{ route('admin.vendor.index') }}">Vendor</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-shopping-cart "></i>
            <span>Transaksi</span>
        </a>
        <div id="collapseFour" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Transaksi</h6>
                <a class="collapse-item {{ Request::path() === 'admin/permintaan' ? 'active' : '' }}" href="{{ route('admin.permintaan.index') }}">Permintaan</a>
                <a class="collapse-item {{ Request::path() === 'admin/penerimaan' ? 'active' : '' }}" href="{{ route('admin.penerimaan.index') }}">Penerimaan</a>
                <a class="collapse-item {{ Request::path() === 'admin/pengeluaran' ? 'active' : '' }}" href="{{ route('admin.pengeluaran.index') }}">Pengeluaran</a>
                <a class="collapse-item {{ Request::path() === 'admin/retur' ? 'active' : '' }}" href="{{ route('admin.retur.index') }}">Pengembalian</a>
                <a class="collapse-item {{ Request::path() === 'admin/stok-bahan' ? 'active' : '' }}" href="{{ route('admin.stok-bahan.index') }}">Stok Bahan</a>
            </div>
        </div>
    </li>
@elseif (Request::path() == 'admin/management-user' || Request::path() == 'admin/kepala-gizi' || Request::path() == 'admin/kategori' ||
         Request::path() == 'admin/bahan-makanan' || Request::path() == 'admin/jenis-makanan' || Request::path() == 'admin/makanan' ||
            Request::path() == 'admin/detail-makanan' || Request::path() == 'admin/satuan-makanan' || Request::path() == 'admin/vendor')
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master
    </div>

    <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Master</span>
        </a>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::path() === 'admin/management-user' ? 'active' : '' }}" href="{{ route('admin.management-user.index') }}">Pengguna</a>
                <a class="collapse-item {{ Request::path() === 'admin/kepala-gizi' ? 'active' : '' }}" href="{{ route('admin.kepala-gizi.index') }}">Penanggung Jawab</a>
                <hr class="divider">
                <a class="collapse-item {{ Request::path() === 'admin/kategori' ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}">Kategori Bhn Mkn</a>
                <a class="collapse-item {{ Request::path() === 'admin/bahan-makanan' ? 'active' : '' }}"  href="{{ route('admin.bahan-makanan.index') }}">Bahan Makanan</a>
                <a class="collapse-item {{ Request::path() === 'admin/jenis-makanan' ? 'active' : '' }}" href="{{ route('admin.jenis-makanan.index') }}">Jenis Makanan</a>
                <a class="collapse-item {{ Request::path() === 'admin/makanan' ? 'active' : '' }}" href="{{ route('admin.makanan.index') }}">Menu Makanan</a>
                <a class="collapse-item {{ Request::path() === 'admin/detail-makanan' ? 'active' : '' }}" href="{{ route('admin.detail-makanan.index') }}">Detail Bahan Makanan</a>
                <hr class="divider">
                <a class="collapse-item {{ Request::path() === 'admin/satuan-makanan' ? 'active' : '' }}" href="{{ route('admin.satuan-makanan.index') }}">Satuan Makanan</a>
                <a class="collapse-item {{ Request::path() === 'admin/vendor' ? 'active' : '' }}" href="{{ route('admin.vendor.index') }}">Vendor</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-shopping-cart "></i>
            <span>Transaksi</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Transaksi</h6>
                <a class="collapse-item {{ Request::path() === 'admin/permintaan' ? 'active' : '' }}" href="{{ route('admin.permintaan.index') }}">Permintaan</a>
                <a class="collapse-item {{ Request::path() === 'admin/penerimaan' ? 'active' : '' }}" href="{{ route('admin.penerimaan.index') }}">Penerimaan</a>
                <a class="collapse-item {{ Request::path() === 'admin/pengeluaran' ? 'active' : '' }}" href="{{ route('admin.pengeluaran.index') }}">Pengeluaran</a>
                <a class="collapse-item {{ Request::path() === 'admin/retur' ? 'active' : '' }}" href="{{ route('admin.retur.index') }}">Pengembalian</a>
                <a class="collapse-item {{ Request::path() === 'admin/stok-bahan' ? 'active' : '' }}" href="{{ route('admin.stok-bahan.index') }}">Stok Bahan</a>
            </div>
        </div>
    </li>
@else
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master
    </div>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::path() === 'admin/management-user' ? 'active' : '' }}" href="{{ route('admin.management-user.index') }}">Pengguna</a>
                <a class="collapse-item {{ Request::path() === 'admin/kepala-gizi' ? 'active' : '' }}" href="{{ route('admin.kepala-gizi.index') }}">Penanggung Jawab</a>
                <hr class="divider">
                <a class="collapse-item {{ Request::path() === 'admin/kategori' ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}">Kategori Bhn Mkn</a>
                <a class="collapse-item {{ Request::path() === 'admin/bahan-makanan' ? 'active' : '' }}"  href="{{ route('admin.bahan-makanan.index') }}">Bahan Makanan</a>
                <a class="collapse-item {{ Request::path() === 'admin/jenis-makanan' ? 'active' : '' }}" href="{{ route('admin.jenis-makanan.index') }}">Jenis Makanan</a>
                <a class="collapse-item {{ Request::path() === 'admin/makanan' ? 'active' : '' }}" href="{{ route('admin.makanan.index') }}">Menu Makanan</a>
                <a class="collapse-item {{ Request::path() === 'admin/detail-makanan' ? 'active' : '' }}" href="{{ route('admin.detail-makanan.index') }}">Detail Bahan Makanan</a>
                <hr class="divider">
                <a class="collapse-item {{ Request::path() === 'admin/satuan-makanan' ? 'active' : '' }}" href="{{ route('admin.satuan-makanan.index') }}">Satuan Makanan</a>
                <a class="collapse-item {{ Request::path() === 'admin/vendor' ? 'active' : '' }}" href="{{ route('admin.vendor.index') }}">Vendor</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-shopping-cart "></i>
            <span>Transaksi</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Transaksi</h6>
                <a class="collapse-item {{ Request::path() === 'admin/permintaan' ? 'active' : '' }}" href="{{ route('admin.permintaan.index') }}">Permintaan</a>
                <a class="collapse-item {{ Request::path() === 'admin/penerimaan' ? 'active' : '' }}" href="{{ route('admin.penerimaan.index') }}">Penerimaan</a>
                <a class="collapse-item {{ Request::path() === 'admin/pengeluaran' ? 'active' : '' }}" href="{{ route('admin.pengeluaran.index') }}">Pengeluaran</a>
                <a class="collapse-item {{ Request::path() === 'admin/retur' ? 'active' : '' }}" href="{{ route('admin.retur.index') }}">Pengembalian</a>
                <a class="collapse-item {{ Request::path() === 'admin/stok-bahan' ? 'active' : '' }}" href="{{ route('admin.stok-bahan.index') }}">Stok Bahan</a>
            </div>
        </div>
    </li>
@endif




