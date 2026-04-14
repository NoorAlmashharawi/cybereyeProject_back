<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>مشغل الفيديوهات | CyberEye</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/sweetalert2@11"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background: #0a0c10;
            color: #e0e0e0;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                linear-gradient(90deg, rgba(0, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(0deg, rgba(0, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
            z-index: 0;
        }

        .player-container {
            display: flex;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        .sidebar {
            width: 380px;
            background: rgba(10, 14, 23, 0.95);
            backdrop-filter: blur(10px);
            border-left: 1px solid rgba(0, 255, 255, 0.2);
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto;
            box-shadow: -5px 0 30px rgba(0, 255, 255, 0.05);
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(0, 255, 255, 0.2);
            background: rgba(10, 14, 23, 0.8);
        }

        .sidebar-header h2 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #00ffcc;
            display: flex;
            align-items: center;
            gap: 10px;
            text-shadow: 0 0 10px rgba(0, 255, 204, 0.3);
        }

        .admin-actions-header {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid rgba(0, 255, 255, 0.2);
        }

        .admin-btn {
            flex: 1;
            padding: 10px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .admin-btn-add {
            background: linear-gradient(135deg, #00cc88, #009966);
            color: white;
            box-shadow: 0 0 15px rgba(0, 204, 136, 0.3);
        }

        .admin-btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 25px rgba(0, 204, 136, 0.5);
        }

        .videos-list {
            flex: 1;
            padding: 15px;
        }

        .video-item {
            display: flex;
            gap: 12px;
            padding: 12px;
            margin-bottom: 12px;
            background: rgba(20, 25, 40, 0.8);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s;
            border: 1px solid rgba(0, 255, 255, 0.1);
            position: relative;
            backdrop-filter: blur(5px);
        }

        .video-item:hover,
        .video-item.active {
            background: rgba(0, 255, 204, 0.1);
            border-color: #00ffcc;
            box-shadow: 0 0 20px rgba(0, 255, 204, 0.2);
            transform: translateX(-5px);
        }

        .video-thumb {
            width: 100px;
            height: 70px;
            background: linear-gradient(135deg, #0a0c10, #1a1f2e);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #00ffcc;
            font-size: 1.8rem;
            border: 1px solid rgba(0, 255, 204, 0.3);
        }

        .video-info {
            flex: 1;
        }

        .video-title {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 5px;
            color: #e0e0e0;
        }

        .video-duration {
            font-size: 0.75rem;
            color: #888;
        }

        .video-item-actions {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            gap: 5px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .video-item:hover .video-item-actions {
            opacity: 1;
        }

        .icon-btn {
            background: rgba(30, 35, 50, 0.9);
            border: 1px solid rgba(0, 255, 204, 0.3);
            color: #00ffcc;
            width: 30px;
            height: 30px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-btn:hover {
            background: #00ffcc;
            color: #0a0c10;
            box-shadow: 0 0 15px rgba(0, 255, 204, 0.5);
        }

        .icon-btn.delete:hover {
            background: #ff3366;
            border-color: #ff3366;
            color: white;
        }

        .main-content {
            flex: 1;
            padding: 30px;
        }

        .welcome-section {
            margin-bottom: 30px;
        }

        .hero-header {
            background: linear-gradient(135deg, #0a0c10, #0d1117);
            border: 1px solid rgba(0, 255, 204, 0.3);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 0 30px rgba(0, 255, 204, 0.05);
            position: relative;
            overflow: hidden;
        }

        .hero-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(0, 255, 204, 0.05), transparent);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }

        .hero-header h1 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #00ffcc;
            text-shadow: 0 0 10px rgba(0, 255, 204, 0.3);
        }

        .stats-cards {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .stat-card {
            background: rgba(0, 255, 204, 0.1);
            border: 1px solid rgba(0, 255, 204, 0.3);
            padding: 10px 20px;
            border-radius: 12px;
            text-align: center;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #00ffcc;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #888;
        }

        .video-wrapper {
            background: #000;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 25px;
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            height: 0;
            border: 1px solid rgba(0, 255, 204, 0.3);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
        }

        .video-wrapper video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .empty-player {
            background: rgba(20, 25, 40, 0.8);
            border: 1px solid rgba(0, 255, 204, 0.2);
            border-radius: 16px;
            padding: 60px;
            text-align: center;
            margin-bottom: 25px;
            backdrop-filter: blur(10px);
        }

        .empty-player i {
            font-size: 4rem;
            color: #00ffcc;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-player h3 {
            margin-bottom: 10px;
            color: #e0e0e0;
        }

        .empty-player p {
            color: #888;
        }

        .video-details {
            background: rgba(20, 25, 40, 0.8);
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 16px;
            border: 1px solid rgba(0, 255, 204, 0.2);
        }

        .video-details h1 {
            font-size: 1.5rem;
            margin-bottom: 12px;
            color: #00ffcc;
        }

        .video-description {
            color: #aaa;
            line-height: 1.6;
            margin-top: 10px;
        }

        .details-actions {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(0, 255, 204, 0.2);
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #00ffcc;
            text-decoration: none;
            transition: all 0.3s;
        }

        .back-link:hover {
            text-shadow: 0 0 10px rgba(0, 255, 204, 0.5);
            transform: translateX(-5px);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(10px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: rgba(10, 14, 23, 0.95);
            border-radius: 20px;
            padding: 30px;
            max-width: 500px;
            width: 90%;
            border: 1px solid rgba(0, 255, 204, 0.3);
            box-shadow: 0 0 50px rgba(0, 255, 204, 0.1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-header h3 {
            color: #00ffcc;
        }

        .close-modal {
            background: none;
            border: none;
            color: #888;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .close-modal:hover {
            color: #ff3366;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #00ffcc;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            background: rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(0, 255, 204, 0.3);
            border-radius: 10px;
            color: white;
            font-family: 'Cairo', sans-serif;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #00ffcc;
            box-shadow: 0 0 10px rgba(0, 255, 204, 0.3);
        }

        .modal-actions {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .btn-save {
            flex: 1;
            background: linear-gradient(135deg, #00cc88, #009966);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-save:hover {
            box-shadow: 0 0 15px rgba(0, 204, 136, 0.5);
            transform: translateY(-2px);
        }

        .btn-cancel {
            flex: 1;
            background: rgba(30, 35, 50, 0.8);
            color: #aaa;
            border: 1px solid rgba(0, 255, 204, 0.3);
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-cancel:hover {
            background: rgba(255, 51, 102, 0.2);
            border-color: #ff3366;
            color: #ff3366;
        }

        @media (max-width: 800px) {
            .player-container {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .videos-list {
                display: flex;
                overflow-x: auto;
            }
            .video-item {
                min-width: 260px;
            }
        }

        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #0a0c10;
        }
        ::-webkit-scrollbar-thumb {
            background: #00ffcc;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #00cc88;
        }
    </style>
</head>

<body>

    <div class="player-container">
        <!-- القائمة الجانبية -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-list"></i> قائمة التشغيل</h2>
                <p style="color: #888;">{{ $videos->count() }} فيديو</p>
                <div class="admin-actions-header">
                    <button class="admin-btn admin-btn-add" onclick="openAddModal()">
                        <i class="fas fa-plus"></i> إضافة فيديو جديد
                    </button>
                </div>
            </div>
            <div class="videos-list" id="videosList">
                @foreach ($videos as $video)
                    <div class="video-item" data-id="{{ $video->id }}" data-title="{{ $video->title }}"
                        data-description="{{ $video->description }}" data-url="{{ asset($video->url) }}"
                        data-duration="{{ $video->duration }}">
                        <div class="video-thumb">
                            <i class="fas fa-play-circle"></i>
                        </div>
                        <div class="video-info">
                            <div class="video-title">{{ $video->title }}</div>
                            <div class="video-duration">
                                @php
                                    $duration = $video->duration ?? 0;
                                @endphp
                                @if ($duration > 0)
                                    {{ floor($duration / 60) }}:{{ str_pad($duration % 60, 2, '0', STR_PAD_LEFT) }}
                                @else
                                    المدة غير محددة
                                @endif
                            </div>
                        </div>
                        <div class="video-item-actions">
                            <button class="icon-btn edit"
                                onclick="event.stopPropagation(); openEditModal({{ $video->id }}, '{{ addslashes($video->title) }}', '{{ addslashes($video->description) }}', {{ $video->duration ?? 0 }})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="icon-btn delete"
                                onclick="event.stopPropagation(); deleteVideo({{ $video->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </aside>

        <!-- منطقة الفيديو الرئيسية -->
        <main class="main-content">
            <a href="{{ url('/') }}" class="back-link"><i class="fas fa-arrow-right"></i> العودة للرئيسية</a>

            <div class="welcome-section">
                <div class="hero-header">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <div>
                            <h1><i class="fas fa-video"></i> مشغل الفيديوهات التعليمية</h1>
                            <p style="color: #888; margin-top: 10px;">
                                استمتع بمشاهدة الفيديوهات وتعلم الأمن السيبراني بطريقة تفاعلية
                            </p>
                        </div>
                        <div class="stats-cards">
                            <div class="stat-card">
                                <div class="stat-number">{{ $videos->count() }}</div>
                                <div class="stat-label">فيديو</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number">{{ number_format($videos->sum('duration') / 60, 0) }}</div>
                                <div class="stat-label">دقيقة</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($videos->isEmpty())
                <div class="empty-player">
                    <i class="fas fa-video-slash"></i>
                    <h3>لا توجد فيديوهات حالياً</h3>
                    <p>أضف فيديو جديد لبدء المشاهدة</p>
                    <button class="admin-btn admin-btn-add" style="margin-top: 20px;" onclick="openAddModal()">
                        <i class="fas fa-plus"></i> أضف أول فيديو
                    </button>
                </div>
            @else
                <div id="videoPlayerArea">
                    <div class="video-wrapper" id="videoWrapper">
                        <video id="mainVideo" controls>
                            <source src="{{ asset($videos->first()->url) }}" type="video/mp4">
                        </video>
                    </div>
                    <div class="video-details" id="videoDetails">
                        <h1 id="videoTitle">{{ $videos->first()->title }}</h1>
                        <div id="videoDescription" class="video-description">
                            {{ $videos->first()->description ?? 'لا يوجد وصف' }}
                        </div>
                        <div class="details-actions">
                            <button class="admin-btn admin-btn-add" id="editCurrentBtn"
                                onclick="openEditModal({{ $videos->first()->id }}, '{{ addslashes($videos->first()->title) }}', '{{ addslashes($videos->first()->description) }}', {{ $videos->first()->duration ?? 0 }})">
                                <i class="fas fa-edit"></i> تعديل هذا الفيديو
                            </button>
                            <button class="admin-btn admin-btn-add" onclick="openAddModal()">
                                <i class="fas fa-plus"></i> إضافة فيديو جديد
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </main>
    </div>

    <!-- مودال إضافة/تعديل فيديو -->
    <div id="videoModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">إضافة فيديو جديد</h3>
                <button class="close-modal" onclick="closeModal()">&times;</button>
            </div>
            <form id="videoForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="videoId" name="videoId">
                <div class="form-group">
                    <label>عنوان الفيديو *</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label>وصف الفيديو</label>
                    <textarea id="description" name="description" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label>مدة الفيديو (بالثواني)</label>
                    <input type="number" id="duration" name="duration" placeholder="مثال: 3600">
                </div>
                <div class="form-group" id="fileInputGroup">
                    <label>رفع الفيديو</label>
                    <input type="file" id="videoFile" name="videoFile" accept="video/*">
                    <small style="color: #888;">MP4, MKV, AVI, MOV (الحد الأقصى 100MB)</small>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeModal()">إلغاء</button>
                    <button type="submit" class="btn-save">حفظ</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentVideoId = {{ $videos->first()->id ?? 0 }};
        let isEditMode = false;

        const video = document.getElementById('mainVideo');
        
        // ✅ التحقق من وجود عنصر الفيديو قبل استخدامه
        if (video) {
            if (currentVideoId) {
                const savedTime = localStorage.getItem(`video_time_${currentVideoId}`);
                if (savedTime && video.duration) {
                    video.currentTime = parseFloat(savedTime);
                }
            }

            video.addEventListener('timeupdate', () => {
                if (currentVideoId) {
                    localStorage.setItem(`video_time_${currentVideoId}`, video.currentTime);
                }
            });
        }

        function loadVideo(videoId, title, description, url, duration) {
            const videoEl = document.getElementById('mainVideo');
            if (!videoEl) return;
            
            const wasPlaying = !videoEl.paused;
            const currentTime = videoEl.currentTime;

            if (currentVideoId) {
                localStorage.setItem(`video_time_${currentVideoId}`, currentTime);
            }

            currentVideoId = videoId;

            document.getElementById('videoTitle').innerText = title;
            document.getElementById('videoDescription').innerHTML = description || 'لا يوجد وصف';

            const source = videoEl.querySelector('source');
            source.src = url;
            videoEl.load();

            const saved = localStorage.getItem(`video_time_${videoId}`);
            if (saved) {
                videoEl.currentTime = parseFloat(saved);
            } else {
                videoEl.currentTime = 0;
            }

            if (wasPlaying) {
                videoEl.play();
            }

            document.getElementById('editCurrentBtn').onclick = function() {
                openEditModal(videoId, title, description, duration);
            };

            document.querySelectorAll('.video-item').forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('data-id') == videoId) {
                    item.classList.add('active');
                }
            });
        }

        document.querySelectorAll('.video-item').forEach(item => {
            item.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const title = this.getAttribute('data-title');
                const description = this.getAttribute('data-description');
                const url = this.getAttribute('data-url');
                const duration = this.getAttribute('data-duration');
                loadVideo(id, title, description, url, duration);
            });
        });

        function openAddModal() {
            isEditMode = false;
            document.getElementById('modalTitle').innerText = 'إضافة فيديو جديد';
            document.getElementById('videoForm').reset();
            document.getElementById('videoId').value = '';
            document.getElementById('duration').value = '';
            document.getElementById('fileInputGroup').style.display = 'block';
            document.getElementById('videoModal').style.display = 'flex';
        }

        function openEditModal(id, title, description, duration) {
            isEditMode = true;
            document.getElementById('modalTitle').innerText = 'تعديل الفيديو';
            document.getElementById('videoId').value = id;
            document.getElementById('title').value = title;
            document.getElementById('description').value = description;
            document.getElementById('duration').value = duration;
            document.getElementById('fileInputGroup').style.display = 'block';
            document.getElementById('videoFile').value = '';
            document.getElementById('videoModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('videoModal').style.display = 'none';
        }

        document.getElementById('videoForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const videoId = document.getElementById('videoId').value;
            const title = document.getElementById('title').value;
            const description = document.getElementById('description').value;
            let duration = document.getElementById('duration').value;
            const videoFile = document.getElementById('videoFile').files[0];

            if (!title) {
                Swal.fire('خطأ', 'الرجاء إدخال عنوان الفيديو', 'error');
                return;
            }

            if (duration === '' || duration === null) {
                duration = 0;
            }

            let url = '{{ route('videos.store') }}';
            let method = 'POST';
            let formData = new FormData();

            if (isEditMode && videoId) {
                url = `/cms/admin/videos/${videoId}`;
                method = 'POST';
                formData.append('_method', 'PUT');
            }

            formData.append('title', title);
            formData.append('description', description);
            formData.append('duration', duration);

            if (videoFile) {
                formData.append('url', videoFile);
            }

            try {
                const response = await axios({
                    method: method,
                    url: url,
                    data: formData,
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });

                if (response.status === 200 || response.status === 201) {
                    Swal.fire('نجاح', isEditMode ? 'تم تحديث الفيديو بنجاح' : 'تم إضافة الفيديو بنجاح', 'success')
                        .then(() => window.location.reload());
                }
            } catch (error) {
                let errorMsg = error.response?.data?.message || 'حدث خطأ أثناء الحفظ';
                Swal.fire('خطأ', errorMsg, 'error');
            }
        });

        async function deleteVideo(id) {
            const result = await Swal.fire({
                title: 'هل أنت متأكد؟',
                text: 'لن تتمكن من استعادة هذا الفيديو!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'نعم، احذف',
                cancelButtonText: 'إلغاء'
            });

            if (result.isConfirmed) {
                try {
                    await axios.delete(`/cms/admin/videos/${id}`);
                    Swal.fire('تم الحذف', 'تم حذف الفيديو بنجاح', 'success')
                        .then(() => window.location.reload());
                } catch (error) {
                    Swal.fire('خطأ', 'حدث خطأ أثناء الحذف', 'error');
                }
            }
        }

        window.onclick = function(event) {
            const modal = document.getElementById('videoModal');
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>

</body>

</html>