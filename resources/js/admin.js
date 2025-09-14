import Alpine from 'alpinejs'
import persist from '@alpinejs/persist'

// Plugin Alpine
Alpine.plugin(persist)

// Make Alpine available globally
window.Alpine = Alpine

// Start Alpine
Alpine.start()

// Search functionality
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input')
    const searchButton = document.getElementById('search-button')

    if (searchInput && searchButton) {
        // Function to focus the search input
        function focusSearchInput() {
            searchInput.focus()
        }

        // Add click event listener to the search button
        searchButton.addEventListener('click', focusSearchInput)

        // Add keyboard event listener for Cmd+K (Mac) or Ctrl+K (Windows/Linux)
        document.addEventListener('keydown', function (event) {
            if ((event.metaKey || event.ctrlKey) && event.key === 'k') {
                event.preventDefault() // Prevent the default browser behavior
                focusSearchInput()
            }
        })
    }
})

// Console log to verify script is loaded
console.log('Admin JS loaded successfully')
