export function createSliders() {
    let slider1 = document.createElement('div');
    let slider2 = document.createElement('div');

    slider1.classList.add('slider');
    slider2.classList.add('slider');
    slider1.style.backgroundColor = '#DBCFBD';
    slider2.style.backgroundColor = '#F9E6D6';

    slider1.innerHTML = `
        <div class="big-title" style="color: #515151;">L’impressionnisme</div>
        <div class="big-title-rev" style="color: #F3ECDC;">L’impressionnisme</div>
    `;

    slider2.innerHTML = `
        <div class="big-title" style="color: #DBCFBD;">L’impressionnisme</div>
        <div class="big-title-rev" style="color: #515151;">L’impressionnisme</div>
    `;

    document.body.appendChild(slider1);
    document.body.appendChild(slider2);

    return [slider1, slider2];
}