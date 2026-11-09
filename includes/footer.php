    </main>
    <footer>
        <p>&copy; 2026-2027 - IPNet Institute of Technology | UE Développement Web I</p>
    </footer>

    <!-- Ouvre/ferme le menu sur mobile -->
    <script>
        const bouton = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('nav-links');

        bouton.addEventListener('click', function () {
            // toggle() retourne true si la classe vient d'être ajoutée
            const ouvert = menu.classList.toggle('active');
            bouton.setAttribute('aria-expanded', ouvert);
        });
    </script>
</body>
</html>
