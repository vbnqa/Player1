        // إنشاء أزرار التنقل بين الصفحات
        function createPagination() {
            const paginationContainer = document.getElementById('pagination');
            paginationContainer.innerHTML = '';

            const totalPages = Math.ceil(allPlayers.length / PLAYERS_PER_PAGE);

            // زر الصفحة السابقة
            const prevButton = document.createElement('button');
            prevButton.textContent = 'السابق';
            prevButton.disabled = currentPage === 1;
            prevButton.addEventListener('click', () => displayPage(currentPage - 1));
            paginationContainer.appendChild(prevButton);

            // أزرار أرقام الصفحات
            for (let i = 1; i <= totalPages; i++) {
                const pageButton = document.createElement('button');
                pageButton.textContent = i;
                pageButton.style.backgroundColor = i === currentPage ? '#2980b9' : '#3498db';
                pageButton.addEventListener('click', () => displayPage(i));
                paginationContainer.appendChild(pageButton);
            }

            // زر الصفحة التالية
            const nextButton = document.createElement('button');
            nextButton.textContent = 'التالي';
            nextButton.disabled = currentPage === totalPages;
            nextButton.addEventListener('click', () => displayPage(currentPage + 1));
            paginationContainer.appendChild(nextButton);
        }

        // الحصول على الجنسية بالعربية
        function getArabicNationality(code) {
            const nationalities = {
                saudi: 'سعودي',
                egyptian: 'مصري',
                emirati: 'إماراتي',
                kuwaiti: 'كويتي',
                bahraini: 'بحرييني',
                omani: 'عماني',
                qatari: 'قطري',
                // يمكن إضافة المزيد حسب الحاجة
            };
            return nationalities[code] || code;
        }

        // عرض تفاصيل اللاعب
        function showPlayerDetails(playerId) {
            const player = allPlayers.find(p => p.id === playerId);
            if (!player) return;

            document.getElementById('playersListView').style.display = 'none';
            const detailsView = document.getElementById('playerDetailsView');
            detailsView.style.display = 'block';

            // تحديث الصورة
            const imgContainer = detailsView.querySelector('.player-image');
            if (player.playerPhoto) {
                imgContainer.innerHTML = `<img src="${player.playerPhoto}" alt="صورة اللاعب" class="player-image">`;
            } else {
                imgContainer.textContent = 'صورة اللاعب غير متوفرة';
            }

            // تحديث التفاصيل
            const detailsHtml = `
                <dt>الاسم الكامل:</dt><dd>${player.playerName}</dd>
                <dt>تاريخ الميلاد:</dt><dd>${player.birthDay}/${player.birthMonth}/${player.birthYear}</dd>
                <dt>الجنسية:</dt><dd>${player.nationality === 'other' ? player.otherNationality : getArabicNationality(player.nationality)}</dd>
                <dt>رقم الهاتف:</dt><dd>${player.playerPhone}</dd>
                <dt>البريد الإلكتروني:</dt><dd>${player.email}</dd>
                <dt>المستوى:</dt><dd>${player.experienceLevel}</dd>
                <dt>الطول (سم):</dt><dd>${player.playerHeight}</dd>
                <dt>الوزن (كجم):</dt><dd>${player.playerWeight}</dd>
                <dt>تاريخ التسجيل:</dt><dd>${new Date(player.timestamp).toLocaleDateString()}</dd>
            `;
            document.getElementById('playerDetails').innerHTML = detailsHtml;
        }

        // حذف اللاعب
        function deletePlayer(playerId) {
            if (!confirm('هل أنت متأكد من رغبتك في حذف هذا اللاعب؟')) return;

            allPlayers = allPlayers.filter(p => p.id !== playerId);
            localStorage.setItem('bowlingPlayers', JSON.stringify(allPlayers));
            loadPlayers();
        }

        // أحداث الأزرار الإضافية
        document.getElementById('printPlayerBtn').addEventListener('click', () => {
            window.print();
        });

        document.getElementById('backToListBtn').addEventListener('click', () => {
            document.getElementById('playerDetailsView').style.display = 'none';
            document.getElementById('playersListView').style.display = 'block';
        });

        // تهيئة أولية
        document.getElementById('adminContainer').style.display = 'none';
        document.getElementById('playerDetailsView').style.display = 'none';
    </script>
</body>
</html>