<link rel="stylesheet" href="../A_View/css/profile.css">
<link rel="stylesheet" href="../A_View/css/followers_view.css">

<form id="searchForm" action="../A_Controller/followers_controller.php" method="get" class="search-form">
    <input type="hidden" name="user_id" value="<?= $target_id ?>">
    <input type="hidden" name="type" value="<?= $type ?>">
    <input type="text" name="search" placeholder="Search username..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Search</button>
</form>
 
<div class="all-user-list">
    <div id="userListContainer" class="user-list-container">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="user-list-item">
                    <img src="../uploads/<?= htmlspecialchars($row['profilepic'] ?? 'default.png'); ?>" alt="Profile Picture">
                    <div class="user-info">
                        <a href="main.php?page=profile&id=<?= $row['id'] ?>"><?= htmlspecialchars($row['username']) ?></a>
                    </div>

                    <?php if ($logged_in_user && $logged_in_user != $row['id']): ?>
                        <div class="follow-button-wrapper">
                            <?php if (!is_following($logged_in_user, $row['id'])): ?>
                                <button class='follow-btn' data-user-id="<?= htmlspecialchars($row['id']) ?>"
                                    data-follow='1'>Follow</button>
                            <?php else: ?>
                                <button class='follow-btn' data-user-id="<?= htmlspecialchars($row['id']) ?>"
                                    data-follow='0'>Unfollow</button>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="color: #ccc; text-align: center; width: 100%;">No <?= htmlspecialchars($type) ?> found.</p>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const userListContainer = document.getElementById('userListContainer');

    if (searchForm && userListContainer) { // Pastikan elemen ada
        searchForm.addEventListener('submit', async function(event) {
            event.preventDefault(); // Mencegah submit form default (agar tidak me-reload halaman)

            const userId = searchForm.querySelector('input[name="user_id"]').value;
            const type = searchForm.querySelector('input[name="type"]').value;
            const searchQuery = searchForm.querySelector('input[name="search"]').value;

            // Buat URL untuk permintaan AJAX ke controller PHP
            // Tambahkan parameter `ajax=1` untuk memberitahu controller ini adalah request AJAX
            const url = `../A_Controller/followers_controller.php?user_id=<span class="math-inline">\{encodeURIComponent\(userId\)\}&type\=</span>{encodeURIComponent(type)}&search=${encodeURIComponent(searchQuery)}&ajax=1`;

            try {
                // Kirim permintaan AJAX menggunakan Fetch API
                const response = await fetch(url);

                // Periksa apakah respons HTTP sukses (status 200 OK)
                if (!response.ok) {
                    console.error(`HTTP error! Status: ${response.status}`);
                    userListContainer.innerHTML = '<p style="color: red; text-align: center; width: 100%;">Server error. Please try again.</p>';
                    return; // Hentikan eksekusi jika ada error HTTP
                }

                // Ambil respons sebagai teks (berisi HTML fragment dari controller)
                const htmlContent = await response.text();

                // Untuk debugging: tampilkan respons di konsol
                console.log("AJAX Response HTML:", htmlContent);

                // Perbarui konten kontainer daftar user dengan HTML yang diterima
                userListContainer.innerHTML = htmlContent;

                // Catatan: Jika Anda memiliki skrip terpisah untuk menginisialisasi tombol follow/unfollow,
                // dan skrip itu tidak menggunakan event delegation (misalnya jQuery .on()),
                // Anda mungkin perlu memanggil ulang fungsi inisialisasi di sini
                // karena elemen tombol baru ditambahkan ke DOM.
                // Contoh: initializeFollowButtons();

            } catch (error) {
                // Tangani error jika permintaan AJAX itu sendiri gagal (misalnya, masalah jaringan)
                console.error('Error during search AJAX request:', error);
                userListContainer.innerHTML = '<p style="color: red; text-align: center; width: 100%;">Failed to load results. Please check your network connection.</p>';
            }
        });
    } else {
        console.warn("searchForm or userListContainer not found in the DOM.");
    }
});

// Jika file follow.js Anda menggunakan jQuery seperti $(document).on('click', '.follow-btn', ...),
// maka Anda TIDAK perlu memanggil ulang fungsi inisialisasi di atas karena event delegation sudah menangani.
// Jika tidak, Anda mungkin perlu membuat fungsi inisialisasi follow button terpisah dan memanggilnya di sini.
</script>