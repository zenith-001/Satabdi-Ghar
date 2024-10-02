// Function to toggle content visibility
function toggleContent(postId) {
    const content = document.getElementById(postId).querySelector('.blogPostContent');
    const button = document.getElementById(postId).querySelector('.showMoreButton');

    content.classList.toggle('expanded');
    if (content.classList.contains('expanded')) {
        content.style.maxHeight = content.scrollHeight + 'px';
        button.textContent = 'Show Less';
    } else {
        content.style.maxHeight = '150px';
        button.textContent = 'Show More';
    }
}

// Function to adjust text content to display first 150 words
function adjustText(postId) {
    const content = document.getElementById(postId).querySelector('.content');
    const words = content.textContent.trim().split(/\s+/);
    const limit = 150;

    if (words.length > limit) {
        const contentWords = words.slice(0, limit).join(' ');
        content.textContent = contentWords + '...';
        document.getElementById(postId).querySelector('.showMoreButton').style.display = 'block';
    }
}

// Call adjustText function for each blog post to limit text content
document.querySelectorAll('.blogPost').forEach(post => {
    adjustText(post.id);
});

// Event listeners for "Show More" buttons
document.querySelectorAll('.showMoreButton').forEach(button => {
    button.addEventListener('click', () => {
        const postId = button.dataset.postId;
        toggleContent(postId);
    });
});

// Function to adjust the gap between grid items based on their heights
function adjustGap() {
    const gridItems = document.querySelectorAll('.blogPost');
    let maxGap = 0;

    // Find the maximum height among all grid items
    gridItems.forEach(item => {
        const height = item.offsetHeight;
        maxGap = Math.max(maxGap, height);
    });

    // Set the gap between grid items based on the maximum height
    const gapValue = maxGap + 20; // Add some extra space for padding
    document.getElementById('blogGrid').style.gap = gapValue + 'px';
}

// Call the adjustGap function when the window is resized
window.addEventListener('resize', adjustGap);

// Call the adjustGap function initially to set the gap based on initial heights
adjustGap();