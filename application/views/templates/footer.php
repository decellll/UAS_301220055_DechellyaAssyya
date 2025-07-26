            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Custom JS -->
    <script>
        // Initialize AOS Animation
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Auto hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);

        // Confirm delete with modern modal
        function confirmDelete(url) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }

        // Modern loading animation
        function showLoading() {
            Swal.fire({
                title: 'Memproses...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }

        // Success notification
        function showSuccess(message) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: message,
                timer: 3000,
                showConfirmButton: false
            });
        }

        // Error notification
        function showError(message) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: message
            });
        }

        // Form validation
        $(document).ready(function() {
            // Add loading state to buttons
            $('form').on('submit', function() {
                $(this).find('button[type="submit"]').prop('disabled', true);
                $(this).find('button[type="submit"]').html('<span class="loading"></span> Memproses...');
            });

            // Add hover effects to cards
            $('.card').hover(
                function() {
                    $(this).addClass('shadow-lg');
                },
                function() {
                    $(this).removeClass('shadow-lg');
                }
            );

            // Smooth scrolling for anchor links
            $('a[href^="#"]').on('click', function(event) {
                var target = $(this.getAttribute('href'));
                if (target.length) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 100
                    }, 1000);
                }
            });

            // Mobile sidebar toggle
            $('.navbar-toggler').on('click', function() {
                $('.sidebar').toggleClass('show');
            });

            // Close sidebar when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.sidebar, .navbar-toggler').length) {
                    $('.sidebar').removeClass('show');
                }
            });

            // Add parallax effect to background
            $(window).scroll(function() {
                var scrolled = $(this).scrollTop();
                $('.parallax-bg').css('transform', 'translateY(' + (scrolled * 0.5) + 'px)');
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Add typing animation to headings
            $('.typing-animation').each(function() {
                var text = $(this).text();
                $(this).empty();
                var i = 0;
                var timer = setInterval(function() {
                    $(this).text(text.substring(0, i));
                    i++;
                    if (i > text.length) {
                        clearInterval(timer);
                    }
                }.bind(this), 100);
            });
        });

        // Modern table sorting
        function sortTable(table, column) {
            var tbody = table.find('tbody');
            var rows = tbody.find('tr').toArray();
            
            rows.sort(function(a, b) {
                var aVal = $(a).find('td').eq(column).text();
                var bVal = $(b).find('td').eq(column).text();
                return aVal.localeCompare(bVal);
            });
            
            tbody.empty();
            rows.forEach(function(row) {
                tbody.append(row);
            });
        }

        // Search functionality
        function searchTable(input, table) {
            var filter = input.value.toLowerCase();
            var rows = table.find('tbody tr');
            
            rows.each(function() {
                var text = $(this).text().toLowerCase();
                if (text.indexOf(filter) > -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // Export table to CSV
        function exportTableToCSV(table, filename) {
            var csv = [];
            var rows = table.find('tr');
            
            rows.each(function() {
                var row = [];
                $(this).find('td, th').each(function() {
                    row.push('"' + $(this).text() + '"');
                });
                csv.push(row.join(','));
            });
            
            var csvContent = csv.join('\n');
            var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            var link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = filename;
            link.click();
        }

        // Print functionality
        function printTable(table) {
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print</title>');
            printWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">');
            printWindow.document.write('</head><body>');
            printWindow.document.write(table.prop('outerHTML'));
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>

    <!-- SweetAlert2 for modern notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html> 