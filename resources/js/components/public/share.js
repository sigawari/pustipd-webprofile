// share.js

function initShareButtons() {
    document.addEventListener("DOMContentLoaded", function () {
        const mainBtn = document.getElementById("mainShareBtn");
        const shareChoices = document.getElementById("shareChoices");
        let opened = false;

        if (mainBtn && shareChoices) {
            mainBtn.addEventListener("click", function () {
                shareChoices.classList.toggle("active");
                opened = !opened;
                if (opened) shareChoices.focus();
            });

            document.addEventListener("click", function (e) {
                if (
                    opened &&
                    !mainBtn.contains(e.target) &&
                    !shareChoices.contains(e.target)
                ) {
                    shareChoices.classList.remove("active");
                    opened = false;
                }
            });

            shareChoices.addEventListener("keydown", function (e) {
                if (e.key === "Escape") {
                    shareChoices.classList.remove("active");
                    opened = false;
                    mainBtn.blur();
                }
            });
        }
    });
}

function getShareTitle() {
    const titleElem = document.getElementById("judul-berita");
    return titleElem ? titleElem.innerText : document.title;
}

function shareTo(platform) {
    const title = getShareTitle();
    const url = window.location.href;
    const shareText = `Baca Berita Terbaru dari PUSTIPD UIN RF Palembang - ${title} ${url}`;

    if (platform === "wa") {
        window.open(
            "https://wa.me/?text=" + encodeURIComponent(shareText),
            "_blank"
        );
    } else if (platform === "fb") {
        window.open(
            "https://www.facebook.com/sharer/sharer.php?u=" +
                encodeURIComponent(url) +
                "&quote=" +
                encodeURIComponent(shareText),
            "_blank"
        );
    } else if (platform === "ig") {
        window.open(
            "https://www.instagram.com/sharer/sharer.php?u=" +
                encodeURIComponent(url) +
                "&quote=" +
                encodeURIComponent(shareText),
            "_blank"
        );
    } else if (platform === "tg") {
        window.open(
            "https://t.me/share/url?url=" +
                encodeURIComponent(url) +
                "&text=" +
                encodeURIComponent(shareText),
            "_blank"
        );
    }
}

function copyBeritaLink() {
    const title = getShareTitle();
    const url = window.location.href;
    const textToCopy = `Baca Berita Terbaru dari PUSTIPD UIN RF Palembang - ${title} ${url}`;
    navigator.clipboard.writeText(textToCopy).then(function () {
        alert("Link berita telah disalin!");
    });
}

export { initShareButtons, shareTo, copyBeritaLink };
