export function initImageSwap() {
    const bigBox = document.getElementById('bigPhoto');
    const smallBoxes = document.querySelectorAll('.swap-box');

    if (!bigBox || smallBoxes.length === 0) return;

    smallBoxes.forEach((box) => {
        box.addEventListener('click', () => {
            const smallImg = box.getAttribute('data-img');
            if (!bigBox.style.backgroundImage) return;

            const oldStyle = bigBox.style.backgroundImage;
            const oldImgArr = oldStyle.match(/url\(["']?([^"']*)["']?\)/);
            const oldBigImg = oldImgArr ? oldImgArr[1] : '';

            bigBox.style.backgroundImage = `url('${smallImg}')`;

            box.setAttribute('data-img', oldBigImg);
            const imgEl = box.querySelector('img');
            if (imgEl) imgEl.src = oldBigImg;
        });
    });
}
