         </div> <!--- Cierre de .container-fluid -->
     </div> <!--- Cierre de #content -->
 </div> <!--- Cierre de .wrapper -->
 
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 <!-- Custom JS para la funcionalidad del sidebar -->
 <script>
 document.addEventListener('DOMContentLoaded', function () {
     var sidebarCollapse = document.getElementById('sidebarCollapse');
     var sidebar = document.getElementById('sidebar');
 
     if (sidebarCollapse) {
         sidebarCollapse.addEventListener('click', function () {
             sidebar.classList.toggle('active');
         });
     }
 });
 </script>
 </body>
 </html>
 
