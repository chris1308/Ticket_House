//berfungsi untuk dapatkan current url saat button share ditekan
document.addEventListener('DOMContentLoaded', function () {
        const shareButton = document.getElementById('shareButton');

        shareButton.addEventListener('click', function () {
            // Get the current page URL
            const pageUrl = window.location.href;

            // Copy the URL to the clipboard
            navigator.clipboard.writeText(pageUrl)
                .then(() => {
                    console.log('URL copied to clipboard:', pageUrl);

                    // Optionally, you can provide feedback to the user
                    alert('URL copied to clipboard!');
                })
                .catch((error) => {
                    console.error('Error copying to clipboard:', error);
                });
        });
    });
