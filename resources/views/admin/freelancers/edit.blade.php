@extends('layouts.admin')

@section('content')
    <form action="{{ route('freelancers.update', $freelancer->id) }}" method="post" class="row shadow-sm border bg-white p-3"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h2 class="mb-5 fw-bold text-muted">تعديل بيانات المستقل</h2>
        @include('partials.errors')
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $freelancer->name }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="username" class="form-label">اسم المستخدم</label>
            <input type="text" id="username" name="username" class="form-control" value="{{ $freelancer->username }}"
                required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="phone" class="form-label">رقم الهاتف</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ $freelancer->phone }}"
                required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="email" class="form-label">البريد الالكتروني</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $freelancer->email }}"
                required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="password" class="form-label">كلمة المرور (اتركها فارغة إذا لم ترغب في تغييرها)</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <label for="phone" class="form-label">رقم الهاتف</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ $freelancer->phone }}">
        </div>
        <div class="col-md-12 mb-3">
            <label for="bio" class="form-label">نبذة</label>
            <textarea id="bio" name="bio" class="form-control" rows="3">{{ $freelancer->freelancer->bio }}</textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label for="country" class="form-label">الدولة</label>
            <input type="text" id="country" name="country" class="form-control" value="{{ $freelancer->freelancer->country }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="website" class="form-label">الموقع الالكتروني</label>
            <input type="url" id="website" name="website" class="form-control" value="{{ $freelancer->freelancer->website }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="specification" class="form-label">التخصص</label>
            <input type="text" id="specification" name="specification" class="form-control"
                value="{{ $freelancer->freelancer->specification }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="skills" class="form-label">المهارات</label>
            <div class="input-group">
                <input type="text" id="skill-input" class="form-control" placeholder="أدخل مهارة">
                <button class="btn btn-outline-secondary" type="button" id="add-skill">إضافة</button>
            </div>
            <div id="skills-container" class="mt-2">
                @php
                    $skills = explode(',', $freelancer->freelancer->skills);
                @endphp
                @foreach ($skills as $skill)
                    <span class="badge bg-primary me-2 mb-2">{{ $skill }} <button type="button"
                            class="btn-close btn-close-white ms-1" aria-label="Remove"
                            data-skill="{{ $skill }}"></button></span>
                @endforeach
            </div>
            <input type="hidden" id="skills" name="skills" value="{{ $freelancer->freelancer->skills }}">
        </div>
        <div class="text-center mt-3">
            <input type="submit" value="تحديث" class="btn btn-primary px-5">
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const skillInput = document.getElementById('skill-input');
            const addSkillBtn = document.getElementById('add-skill');
            const skillsContainer = document.getElementById('skills-container');
            const skillsHiddenInput = document.getElementById('skills');
            const skills = new Set(skillsHiddenInput.value.split(',').filter(Boolean));

            function updateSkills() {
                skillsContainer.innerHTML = Array.from(skills).map(skill =>
                    `<span class="badge bg-primary me-2 mb-2">${skill} <button type="button" class="btn-close btn-close-white ms-1" aria-label="Remove" data-skill="${skill}"></button></span>`
                ).join('');
                skillsHiddenInput.value = Array.from(skills).join(',');
            }

            function addSkill(skill) {
                if (skill && !skills.has(skill)) {
                    skills.add(skill);
                    updateSkills();
                    skillInput.value = '';
                }
            }

            addSkillBtn.addEventListener('click', function(e) {
                e.preventDefault();
                addSkill(skillInput.value.trim());
            });

            skillInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addSkill(this.value.trim());
                }
            });

            skillsContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-close')) {
                    const skill = e.target.getAttribute('data-skill');
                    skills.delete(skill);
                    updateSkills();
                }
            });

            // Initialize skills
            updateSkills();
        });
    </script>
@endsection
