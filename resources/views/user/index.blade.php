<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Laut Dalam</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        :root{
            --main:#40e0d0;
            --dark:#0a192f;
            --card:rgba(255,255,255,.08);
        }

        body{
            font-family:'Poppins',sans-serif;
            background:linear-gradient(135deg,#0a192f,#0f3460);
            color:#e0f7fa;
        }

        /* Navbar */
        .navbar{
            background:rgba(10,25,47,.95);
            border-bottom:1px solid rgba(64,224,208,.3);
        }
        .navbar-brand{
            font-weight:700;
            color:var(--main)!important;
        }

        /* Hero */
        .hero{
            padding:120px 15px 70px;
            text-align:center;
        }
        .hero h1{
            font-weight:700;
            background:linear-gradient(135deg,#40e0d0,#00ffff);
            -webkit-background-clip:text;
            color:transparent;
        }
        .hero p{color:#b0e0e6}

        /* Search */
        .search-box{
            max-width:700px;
            margin:30px auto;
            background:rgba(255,255,255,.1);
            border-radius:50px;
            padding:10px 20px;
            display:flex;
            gap:10px;
            border:1px solid rgba(64,224,208,.3);
        }
        .search-box input{
            background:none;
            border:none;
            color:white;
            flex:1;
        }
        .search-box input:focus{outline:none}
        .search-box button{
            background:var(--main);
            border:none;
            border-radius:50%;
            width:45px;
            color:#003;
        }

        /* Cards */
        .book-card{
            background:var(--card);
            border-radius:15px;
            padding:15px;
            height:100%;
            transition:.3s;
        }
        .book-card:hover{
            transform:translateY(-6px);
            box-shadow:0 10px 25px rgba(64,224,208,.2);
        }
        .book-card img{
            width:100%;
            height:230px;
            object-fit:cover;
            border-radius:10px;
        }
        .badge-stock{
            background:linear-gradient(135deg,#40e0d0,#20b2aa);
        }
        .btn-reserve{
            background:linear-gradient(135deg,#40e0d0,#20b2aa);
            border:none;
            color:white;
            width:100%;
        }

        /* Categories */
        .category-btn{
            border:1px solid rgba(64,224,208,.3);
            background:transparent;
            color:#e0f7fa;
            border-radius:30px;
            padding:6px 18px;
            margin:4px;
        }
        .category-btn.active,
        .category-btn:hover{
            background:var(--main);
            color:#003;
        }

        /* Stats */
        .stat{
            font-size:2rem;
            font-weight:700;
            color:var(--main);
        }

        footer{
            margin-top:60px;
            padding:40px 0;
            border-top:1px solid rgba(64,224,208,.3);
            background:rgba(10,25,47,.95);
            text-align:center;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="fa-solid fa-water me-2"></i>Perpustakaan Laut Dalam</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="#books" class="nav-link">Buku</a></li>
                <li class="nav-item"><a href="#categories" class="nav-link">Kategori</a></li>
                <li class="nav-item"><a href="{{ route('buku.transaksi') }}" class="nav-link">Riwayat</a></li>
                <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link text-danger">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="hero">
    <h1>Perpustakaan Laut Dalam</h1>
    <p>Jelajahi pengetahuan seluas samudra</p>
    <div class="mb-4">
     <a href="#books" class="btn btn-lg px-5 py-2 fw-semibold">
    <i class="fa-solid fa-book-open me-2"></i>
    Pilih Buku
</a>

    </div>

    <div class="search-box">
        <i class="fa fa-search text-info mt-2"></i>
        <input type="text" id="searchInput" placeholder="Cari buku...">
        <button><i class="fa fa-search"></i></button>
    </div>
</section>

<!-- Books -->
<section id="books" class="container mb-5">
    <h3 class="text-center mb-4">📚 Koleksi Buku ({{ count($books) }})</h3>

    <div class="row g-4" id="bookGrid">
        @foreach($books as $book)
        <div class="col-lg-3 col-md-4 col-sm-6 book-item"
            data-title="{{ strtolower($book->judul_pustaka) }}"
            data-author="{{ strtolower($book->pengarang->nama_pengarang ?? '') }}"
            data-category="{{ strtolower($book->kategori ?? '') }}">
            <div class="book-card">
                <img src="{{ $book->gambar ? asset('storage/'.$book->gambar) : 'data:image/jpeg;base64,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' }}">
                <h6 class="mt-3">{{ $book->judul_pustaka }}</h6>
                <small class="text-info">{{ $book->pengarang->nama_pengarang ?? '-' }}</small>

                <div class="d-flex justify-content-between mt-2 small">
                    <span>{{ $book->tahun_terbit }}</span>
                    <span>{{ $book->kondisi_buku }}</span>
                </div>

                <span class="badge badge-stock mt-2">
                    Stok: {{ $book->jml_book }}
                </span>

                <button class="btn btn-reserve mt-3"
                    onclick="reserveBook({{ $book->id_pustaka }})"
                    {{ $book->jml_book == 0 ? 'disabled' : '' }}>
                    {{ $book->jml_book ? 'Reservasi' : 'Habis' }}
                </button>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Categories -->
<section id="categories" class="container text-center mb-5">
    <h4 class="mb-3">🏷 Kategori</h4>
    <button class="category-btn active" data-cat="all">Semua</button>
    <button class="category-btn" data-cat="novel">Novel</button>
    <button class="category-btn" data-cat="pelajaran">Pelajaran</button>
    <button class="category-btn" data-cat="ilmiah">Ilmiah</button>
    <button class="category-btn" data-cat="sejarah">Sejarah</button>
</section>

<!-- Stats -->
<section class="container text-center mb-5">
    <div class="row">
        <div class="col"><div class="stat">{{ count($books) }}</div>Buku</div>
        <div class="col"><div class="stat">{{ $availableBooks ?? count($books) }}</div>Tersedia</div>
        <div class="col"><div class="stat">{{ $borrowedBooks ?? 0 }}</div>Dipinjam</div>
        <div class="col"><div class="stat">{{ $totalCategories ?? 8 }}</div>Kategori</div>
    </div>
</section>

<footer>
    <h5><i class="fa-solid fa-water me-2"></i>Perpustakaan Laut Dalam</h5>
    <small>&copy; 2024 Perpustakaan Sekolah</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const searchInput = document.getElementById('searchInput');
    const items = document.querySelectorAll('.book-item');
    const catBtns = document.querySelectorAll('.category-btn');

    searchInput.addEventListener('input',()=>{
        const q = searchInput.value.toLowerCase();
        items.forEach(i=>{
            i.style.display =
                i.dataset.title.includes(q) ||
                i.dataset.author.includes(q) ||
                i.dataset.category.includes(q)
                ? 'block':'none';
        });
    });

    catBtns.forEach(btn=>{
        btn.onclick=()=>{
            catBtns.forEach(b=>b.classList.remove('active'));
            btn.classList.add('active');
            const c = btn.dataset.cat;
            items.forEach(i=>{
                i.style.display = c==='all'||i.dataset.category.includes(c)
                ?'block':'none';
            });
        }
    });

    function reserveBook(id){
        if(confirm('Reservasi buku ini?')){
            alert('Reservasi berhasil 🎉');
        }
    }
</script>

</body>
</html>
