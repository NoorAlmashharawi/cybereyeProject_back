@extends('cms.parent')

@section('title', 'Admin')
@section('main-title', 'لوحة تحكم المشرف')
@section('sub-title', 'مرحبًا بعودتك')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('cms/css/viewStudents.css') }}">

@endsection

@section('content')

<div class="hacker-animation" id="matrixAnimation"></div>

<header>
    <div class="container">
        <h1><i class="fas fa-shield-alt"></i> All Students</h1>
        <p></p>
    </div>
</header>



<div class="container">
    <div class="controls">
    

        <div class="action-buttons">
            <button class="btn btn-primary" id="addStudentBtn" style="background-color: red">
                <a href="{{ route('students_forceAll') }}" style="color:white; text-decoration:none;">
                    <i class="fas fa-user-secret"></i> حذف الجميع
                </a>
            </button>

            <button class="btn btn-secondary">
                <a href="{{ route('students.index') }}" style="color:white; text-decoration:none;">
                    <i class="fas fa-arrow-left"></i> العودة للطلاب
                </a>
            </button>
        </div>
    </div>

    

    <div class="table-container">
        <table id="studentsTable">
            <thead>
                <tr>
                    <th onclick="sortTable(0)"><i class="fas fa-sort"></i> المعرف</th>
                    <th onclick="sortTable(1)"><i class="fas fa-sort"></i> اسم الطالب</th>
                    <th onclick="sortTable(2)"><i class="fas fa-sort"></i> الايميل</th>
                    <th onclick="sortTable(3)"><i class="fas fa-sort"></i> مستوى المهارة</th>
                    <th onclick="sortTable(4)"><i class="fas fa-sort"></i> التخصص</th>
                    <th onclick="sortTable(5)"><i class="fas fa-sort"></i> الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody id="studentsTableBody">
                @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td> 
                    <td>{{ $student->user1->username ?? 'غير محدد' }}</td>  
                    <td>{{ $student->user1->email ?? 'غير محدد' }}</td>  
                    <td>{{ $student->level }}</td>  
                    <td>{{ $student->specialization }}</td>  
                    <td>
                        @if($student->status == 'active')
                            <span class="badge bg-success">نشط</span>
                        @elseif($student->status == 'inactive')
                            <span class="badge bg-secondary">غير نشط</span>
                        @elseif($student->status == 'suspended')
                            <span class="badge bg-warning">موقوف</span>
                        @elseif($student->status == 'graduated')
                            <span class="badge bg-info">متخرج</span>
                        @else
                            <span class="badge bg-dark">{{ $student->status }}</span>
                        @endif
                    </td>
                    <td class="text-center" style="display:flex; gap:5px;">
                   
                     
                        <a href="{{ route('students_restore', $student->id) }}" class="btn-action btn-primary" title="استعادة">
                            <i class="fas fa-trash-restore"></i>
                        </a>

                        <a href="{{ route('students_force', $student->id) }}" class="btn-action btn-danger" title="حذف">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                     
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div id="noResultsMessage" class="no-results" style="display: none;">
            <i class="fas fa-search"></i>
            <h3>لا توجد نتائج</h3>
            <p>لم يتم العثور على طلاب ينطبقون على معايير البحث الخاصة بك</p>
        </div>
    </div>
</div>

<div id="noResultsMessage" class="no-results" style="display: none;">
    <i class="fas fa-search"></i>
    <h3>لا توجد نتائج</h3>
    <p>لم يتم العثور على مدرسين ينطبقون على معايير البحث الخاصة بك</p>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // function performDestroy(id, reference) {
    //     confirmDestroy('/cms/student/students_force/' + id, reference);
    // }

</script>
<script>
  
  

</script>

<script>
    // تنفيذ البحث الفوري
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let searchTerm = this.value.toLowerCase();
        let tableRows = document.querySelectorAll('#studentsTable tbody tr');
        let hasResults = false;
        
        tableRows.forEach(row => {
            let studentName = row.cells[1]?.textContent.toLowerCase() || '';
            let studentId = row.cells[0]?.textContent.toLowerCase() || '';
            let studentEmail = row.cells[2]?.textContent.toLowerCase() || '';
            let studentLevel = row.cells[3]?.textContent.toLowerCase() || '';
            let studentSpecialization = row.cells[4]?.textContent.toLowerCase() || '';
            
            if (studentName.includes(searchTerm) || 
                studentId.includes(searchTerm) || 
                studentEmail.includes(searchTerm) ||
                studentLevel.includes(searchTerm) ||
                studentSpecialization.includes(searchTerm)) {
                row.style.display = '';
                hasResults = true;
                
                row.style.backgroundColor = '#fff3cd';
                setTimeout(() => {
                    row.style.backgroundColor = '';
                }, 500);
            } else {
                row.style.display = 'none';
            }
        });
        
        let noResultsDiv = document.getElementById('noResultsMessage');
        if (!hasResults && searchTerm !== '') {
            noResultsDiv.style.display = 'block';
        } else {
            noResultsDiv.style.display = 'none';
        }
        
        updateSearchStats(searchTerm);
    });
    
    function updateSearchStats(searchTerm) {
        let visibleRows = document.querySelectorAll('#studentsTable tbody tr[style="display: "]').length;
        let totalRows = document.querySelectorAll('#studentsTable tbody tr').length;
        
        let statsDiv = document.getElementById('searchStats');
        if (!statsDiv) {
            statsDiv = document.createElement('div');
            statsDiv.id = 'searchStats';
            statsDiv.className = 'search-stats';
            document.querySelector('.table-container').insertBefore(statsDiv, document.getElementById('studentsTable'));
        }
        
        if (searchTerm !== '') {
            statsDiv.innerHTML = `
                <div class="search-results-info">
                    <i class="fas fa-search"></i>
                    <span>نتائج البحث عن "${searchTerm}": <strong>${visibleRows}</strong> من <strong>${totalRows}</strong> طالب</span>
                    <button onclick="clearSearch()" class="clear-search-btn">
                        <i class="fas fa-times"></i> مسح
                    </button>
                </div>
            `;
            statsDiv.style.display = 'block';
        } else {
            statsDiv.style.display = 'none';
        }
    }
    
    function clearSearch() {
        document.getElementById('searchInput').value = '';
        document.getElementById('searchInput').dispatchEvent(new Event('keyup'));
        document.getElementById('searchStats').style.display = 'none';
    }
    
    function sortTable(columnIndex) {
        let table = document.getElementById('studentsTable');
        let tbody = table.getElementsByTagName('tbody')[0];
        let rows = Array.from(tbody.getElementsByTagName('tr'));
        
        let isAscending = table.querySelectorAll('th')[columnIndex].classList.contains('sort-asc');
        
        table.querySelectorAll('th').forEach(th => {
            th.classList.remove('sort-asc', 'sort-desc');
        });
        
        let currentTh = table.querySelectorAll('th')[columnIndex];
        currentTh.classList.add(isAscending ? 'sort-desc' : 'sort-asc');
        
        rows.sort((a, b) => {
            let aValue = a.cells[columnIndex]?.textContent.trim() || '';
            let bValue = b.cells[columnIndex]?.textContent.trim() || '';
            
            let aNum = parseFloat(aValue);
            let bNum = parseFloat(bValue);
            
            if (!isNaN(aNum) && !isNaN(bNum)) {
                return isAscending ? aNum - bNum : bNum - aNum;
            }
            
            return isAscending ? 
                aValue.localeCompare(bValue, 'ar') : 
                bValue.localeCompare(aValue, 'ar');
        });
        
        rows.forEach(row => tbody.appendChild(row));
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        let searchInput = document.getElementById('searchInput');
        
        searchInput.addEventListener('input', function() {
            let clearIcon = document.querySelector('.search-clear');
            if (this.value.length > 0) {
                if (!clearIcon) {
                    let icon = document.createElement('i');
                    icon.className = 'fas fa-times-circle search-clear';
                    icon.onclick = clearSearch;
                    this.parentNode.appendChild(icon);
                }
            } else {
                if (clearIcon) clearIcon.remove();
            }
        });
    });
</script>
@endsection