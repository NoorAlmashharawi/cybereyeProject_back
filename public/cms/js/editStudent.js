
// تحميل بيانات الطالب (محاكاة)
function loadStudent() {
    const student = {
        fullName: "أحمد محمد",
        email: "ahmad@student.edu",
        phone: "+970599999999",
        birthDate: "2002-06-10",
        nationalId: "1234567890",
        address: "غزة - الرمال",
        username: "ahmad02",
        status: "active",
        bio: "طالب مجتهد"
    };

    fullName.value = student.fullName;
    email.value = student.email;
    phone.value = student.phone;
    birthDate.value = student.birthDate;
    nationalId.value = student.nationalId;
    address.value = student.address;
    username.value = student.username;
    status.value = student.status;
    bio.value = student.bio;

    updatePreview();
}

// معاينة
function updatePreview() {
    pName.textContent = fullName.value || "---";
    pEmail.textContent = email.value || "---";
    pStatus.textContent = status.options[status.selectedIndex]?.text || "---";
}

// تحقق
function validate() {
    if (!fullName.value || !email.value || !birthDate.value || !nationalId.value || !username.value || !status.value) {
        showError("يرجى تعبئة جميع الحقول المطلوبة");
        return false;
    }

    if (password.value || confirmPassword.value) {
        if (password.value !== confirmPassword.value) {
            showError("كلمتا المرور غير متطابقتين");
            return false;
        }
        if (password.value.length < 8) {
            showError("كلمة المرور يجب أن تكون 8 أحرف على الأقل");
            return false;
        }
    }
    return true;
}

function showError(msg) {
    errorMsg.textContent = msg;
    errorAlert.style.display = "block";
    successAlert.style.display = "none";
}

function showSuccess() {
    successAlert.style.display = "block";
    errorAlert.style.display = "none";
}

// حفظ
editStudentForm.addEventListener("submit", function (e) {
    e.preventDefault();
    if (!validate()) return;

    console.log("تم تحديث بيانات الطالب");
    showSuccess();
});

document.addEventListener("DOMContentLoaded", loadStudent);
