export function initShareButtons() {
    const mainBtn = document.getElementById("mainShareBtn");
    const shareChoices = document.getElementById("shareChoices");

    let opened = false;
    if (mainBtn && shareChoices) {
        mainBtn.addEventListener("click", function () {
            shareChoices.style.display = opened ? "none" : "flex";
            opened = !opened;
            if (opened) shareChoices.focus();
        });

        document.addEventListener("click", function (e) {
            if (
                opened &&
                !mainBtn.contains(e.target) &&
                !shareChoices.contains(e.target)
            ) {
                shareChoices.style.display = "none";
                opened = false;
            }
        });

        shareChoices.querySelectorAll(".choice-btn").forEach((btn) => {
            // Copy
            if (btn.id === "copyBtn") {
                btn.addEventListener("click", copyContentLink);
            } else {
                btn.addEventListener("click", () => {
                    const platform = btn.dataset.platform;
                    const shareText = btn.dataset.shareText;
                    const shareUrl = btn.dataset.shareUrl;
                    shareTo(platform, shareUrl, shareText);
                });
            }
        });
    }
}

export function shareTo(platform, url, shareText) {
    const text = `${shareText} ${url}`;
    if (platform === "wa") {
        window.open(
            "https://wa.me/?text=" + encodeURIComponent(text),
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

export function copyContentLink() {
    const copySuccessDiv = document.getElementById("copySuccess");
    const linkToCopy = window.location.href;

    if (
        navigator.clipboard &&
        typeof navigator.clipboard.writeText === "function"
    ) {
        navigator.clipboard.writeText(linkToCopy).then(() => {
            if (copySuccessDiv) {
                copySuccessDiv.style.display = "block";
                setTimeout(() => {
                    copySuccessDiv.style.display = "none";
                }, 2000);
            }
        });
    } else {
        // Fallback untuk browser lama (execCommand)
        const tempInput = document.createElement("input");
        tempInput.value = linkToCopy;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        if (copySuccessDiv) {
            copySuccessDiv.style.display = "block";
            setTimeout(() => {
                copySuccessDiv.style.display = "none";
            }, 2000);
        }
    }
}
