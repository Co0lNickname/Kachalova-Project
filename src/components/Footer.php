<?php
function renderFooter()
{
    ob_start();
    ?>
            </div>
        </main>
        <footer class="main-footer">
            <div class="container">
                <div class="footer-content">
                    <p>&copy; <?= date('Y') ?> Kachalova Project. All rights reserved.</p>
                </div>
            </div>
        </footer>
        <script src="/assets/js/main.js"></script>
    </body>
    </html>
    <?php
    return ob_get_clean();
}
?> 