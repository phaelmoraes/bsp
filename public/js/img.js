let files = [],
    dragArea = document.querySelector('.drag-area'),
    input = document.querySelector('.drag-area input'),
    button = document.querySelector('.card button'),
    select = document.querySelector('.drag-area .select'),
    container = document.querySelector('.container');

select.addEventListener('click', () => input.click());

input.addEventListener('change', () => {
    let newFiles = Array.from(input.files).filter(file => {
        return !files.some(existingFile => existingFile.name === file.name);
    });

    files = files.concat(newFiles);
    showImages();
});

function showImages() {
    container.innerHTML = files.reduce((prev, curr, index) => {
        return `${prev}
            <div class="image">
                <span onclick="delImage(${index})">&times;</span>
                <img src="${URL.createObjectURL(curr)}" />
            </div>`;
    }, '');
}

function delImage(index) {
    files.splice(index, 1);
    showImages();
}

dragArea.addEventListener('dragover', e => {
    e.preventDefault();
    dragArea.classList.add('dragover');
});

dragArea.addEventListener('dragleave', e => {
    e.preventDefault();
    dragArea.classList.remove('dragover');
});

dragArea.addEventListener('drop', e => {
    e.preventDefault();
    dragArea.classList.remove('dragover');

    let newFiles = Array.from(e.dataTransfer.files).filter(file => {
        return !files.some(existingFile => existingFile.name === file.name);
    });

    files = files.concat(newFiles);
    showImages();
});
