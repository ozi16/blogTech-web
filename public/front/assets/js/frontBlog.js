<script>
document.addEventListener("DOMContentLoaded", function () {
    // Ambil elemen yang berisi tanggal
    let dateElement = document.querySelector(".header-info-left ul li:nth-child(2)");

    // Format hari dan tanggal
    let options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
    let today = new Date();
    let formattedDate = today.toLocaleDateString('en-US', options); // Format bahasa Inggris

    // Perbarui konten elemen
    dateElement.innerHTML = `<img src="/front/assets/img/icon/header_icon1.png" alt="">${formattedDate}`;
});
</script>