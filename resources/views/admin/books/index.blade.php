<x-admin.layout :title="'Lumina Media - Kelola Buku'">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body,
        html,
        .main-content,
        main,
        .wrapper {
            background-color: #f5f3ef !important;
            /* Latar Belakang Cream Figma */
            font-family: 'Plus Jakarta Sans', -apple-system, sans-serif !important;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .figma-container {
            font-family: 'Plus Jakarta Sans', -apple-system, sans-serif !important;
            padding: 40px 50px !important;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Navigasi Atas / Header */
        .header-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 32px;
        }

        .title-main {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-size: 28px !important;
            font-weight: 800 !important;
            /* Nilai 800 membuat teks tebal seperti Figma */
            color: #0f3661 !important;
            /* Warna Biru Gelap Lumina */
            letter-spacing: -0.5px !important;
            margin-bottom: 6px;
        }

        .subtitle-main {
            font-size: 13.5px !important;
            color: #6b7280 !important;
            font-weight: 500 !important;
        }

        .btn-add-book {
            background-color: #244cb3 !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            font-size: 13px !important;
            padding: 10px 20px !important;
            border-radius: 8px !important;
            border: none !important;
            text-decoration: none !important;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(36, 76, 179, 0.15);
        }

        /* 4 Grid Stats Card */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .card-stat {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        }

        .stat-label {
            font-size: 12px;
            font-weight: 500;
            color: #8896a6;
            margin-bottom: 14px;
        }

        .stat-value {
            font-size: 26px;
            font-weight: 700;
            color: #081726;
        }

        .icon-wrapper {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bg-total-judul {
            background-color: #e8f1ff;
            color: #244cb3;
        }

        .bg-stok-rendah {
            background-color: #fff6e9;
            color: #d97706;
        }

        .bg-terjual {
            background-color: #e6f9f0;
            color: #10b981;
        }

        .bg-valuasi {
            background-color: #e8f7ff;
            color: #0284c7;
        }

        /* Panel Tabel Daftar Inventaris */
        .table-panel {
            background-color: #ffffff;
            border-radius: 14px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            overflow: hidden;
        }

        .table-header-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 24px;
            border-bottom: 1px solid #f3f4f6;
        }

        .table-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 700;
            color: #1e40af;
        }

        .table-utilities {
            display: flex;
            align-items: center;
            gap: 16px;
            color: #6b7280;
        }

        .btn-utility {
            background: none;
            border: none;
            cursor: pointer;
            color: #6b7280;
            display: flex;
            align-items: center;
        }

        /* Data Table Core Styling */
        .main-data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .main-data-table th {
            font-size: 11px;
            font-weight: 600;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 24px;
            border-bottom: 1px solid #f3f4f6;
            text-align: left;
        }

        .main-data-table td {
            padding: 16px 24px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 13.5px;
            color: #4b5563;
            vertical-align: middle;
        }

        .book-info-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .book-cover-mock {
            width: 34px;
            height: 44px;
            background-color: #000000;
            color: #ffffff;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 7.5px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .text-title-book {
            font-weight: 600;
            color: #1f2937;
        }

        .badge-stock-count {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-stok-aman {
            background-color: #def7ec;
            color: #03543f;
        }

        .badge-stok-melimpah {
            background-color: #e1effe;
            color: #1e429f;
        }

        .badge-stok-warning {
            background-color: #fdf6b2;
            color: #723b13;
        }

        .text-price {
            color: #244cb3;
            font-weight: 600;
        }

        .action-icon-group {
            display: flex;
            gap: 14px;
            justify-content: flex-end;
        }

        .btn-action-trigger {
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .btn-action-trigger:hover {
            color: #4b5563;
        }

        /* Footer / Pagination Table Area */
        .table-footer-pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 24px;
            font-size: 12px;
            color: #9ca3af;
            background-color: #ffffff;
        }

        .pagination-nav-container {
            display: flex;
            gap: 8px;
        }

        .btn-nav-page {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            color: #4b5563;
        }

        .btn-nav-page.active-state {
            color: #244cb3;
            border-color: #244cb3;
        }

        .btn-nav-page:disabled {
            color: #d1d5db;
            cursor: not-allowed;
            border-color: #e5e7eb;
        }
    </style>

    <div class="figma-container">

        <div class="header-wrapper">
            <div>
                <h1 class="title-main">Kelola Buku</h1>
                <p class="subtitle-main">Kelola dan atur stok buku pada Lumina Media</p>
            </div>
            <a href="{{ route('admin.books.create') }}" class="btn-add-book">Tambah Buku</a>
        </div>

        <div class="stats-grid">

            <div class="card-stat">
                <div>
                    <div class="stat-label">Total Judul</div>
                    <div class="stat-value">1,284</div>
                </div>
                <div class="icon-wrapper bg-total-judul">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                    </svg>
                </div>
            </div>

            <div class="card-stat">
                <div>
                    <div class="stat-label">Stok Rendah</div>
                    <div class="stat-value">12</div>
                </div>
                <div class="icon-wrapper bg-stok-rendah">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                        </path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </div>
            </div>

            <div class="card-stat">
                <div>
                    <div class="stat-label">Terjual (Bulan ini)</div>
                    <div class="stat-value">452</div>
                </div>
                <div class="icon-wrapper bg-terjual">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                        <polyline points="17 6 23 6 23 12"></polyline>
                    </svg>
                </div>
            </div>

            <div class="card-stat">
                <div>
                    <div class="stat-label">Valuasi Stok</div>
                    <div class="stat-value">Rp 142M</div>
                </div>
                <div class="icon-wrapper bg-valuasi">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="6" width="20" height="12" rx="2"></rect>
                        <circle cx="12" cy="12" r="2"></circle>
                        <path d="M6 12h.01M18 12h.01"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="table-panel">
            <div class="table-header-area">
                <div class="table-title">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                    Daftar Inventaris Buku
                </div>
                <div class="table-utilities">
                    <button class="btn-utility">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="4" y1="6" x2="20" y2="6"></line>
                            <line x1="7" y1="12" x2="17" y2="12"></line>
                            <line x1="10" y1="18" x2="14" y2="18"></line>
                        </svg>
                    </button>
                    <button class="btn-utility">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                    </button>
                </div>
            </div>

            <table class="main-data-table">
                <thead>
                    <tr>
                        <th style="width: 40%;">Judul Buku</th>
                        <th style="width: 25%;">Penulis</th>
                        <th style="width: 15%;">Stok</th>
                        <th style="width: 15%;">Harga</th>
                        <th style="width: 5%; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="book-info-cell">
                                <div class="book-cover-mock">COVER</div>
                                <span class="text-title-book">JUDUL</span>
                            </div>
                        </td>
                        <td>PENULIS</td>
                        <td><span class="badge-stock-count badge-stok-aman">45</span></td>
                        <td><span class="text-price">Rp 85.000</span></td>
                        <td>
                            <div class="action-icon-group">
                                <button class="btn-action-trigger">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4z"></path>
                                    </svg>
                                </button>
                                <button class="btn-action-trigger">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="book-info-cell">
                                <div class="book-cover-mock">COVER</div>
                                <span class="text-title-book">JUDUL</span>
                            </div>
                        </td>
                        <td>PENULIS</td>
                        <td><span class="badge-stock-count badge-stok-melimpah">120</span></td>
                        <td><span class="text-price">Rp 125.000</span></td>
                        <td>
                            <div class="action-icon-group">
                                <button class="btn-action-trigger">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4z"></path>
                                    </svg>
                                </button>
                                <button class="btn-action-trigger">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="book-info-cell">
                                <div class="book-cover-mock">COVER</div>
                                <span class="text-title-book">JUDUL</span>
                            </div>
                        </td>
                        <td>PENULIS</td>
                        <td><span class="badge-stock-count badge-stok-aman">88</span></td>
                        <td><span class="text-price">Rp 98.000</span></td>
                        <td>
                            <div class="action-icon-group">
                                <button class="btn-action-trigger">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4z"></path>
                                    </svg>
                                </button>
                                <button class="btn-action-trigger">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="book-info-cell">
                                <div class="book-cover-mock">COVER</div>
                                <span class="text-title-book">JUDUL</span>
                            </div>
                        </td>
                        <td>PENULIS</td>
                        <td><span class="badge-stock-count badge-stok-warning">30</span></td>
                        <td><span class="text-price">Rp 75.000</span></td>
                        <td>
                            <div class="action-icon-group">
                                <button class="btn-action-trigger">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4z"></path>
                                    </svg>
                                </button>
                                <button class="btn-action-trigger">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="table-footer-pagination">
                <div>Menampilkan 1-4 dari 24 buku</div>
                <div class="pagination-nav-container">
                    <button class="btn-nav-page" disabled>Sebelumnya</button>
                    <button class="btn-nav-page active-state">Selanjutnya</button>
                </div>
            </div>
        </div>

    </div>

</x-admin.layout>