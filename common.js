
function loadHeader() {
    fetch('header.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById('header-placeholder').innerHTML = data;
            updateLoginStatus();
        });
}

// DOM이 로드되면 header와 footer 로드
document.addEventListener('DOMContentLoaded', () => {
    loadHeader();
    loadFooter();
});

// 로그인 상태 체크 및 표시
function updateLoginStatus() {
    const userInfo = document.getElementById('user-info');
    const username = sessionStorage.getItem('username');
    
    if (username) {
        userInfo.innerHTML = `
            <span class="username">${username}</span>님 환영합니다
            <button onclick="logout()" class="button">로그아웃</button>
        `;
    } else {
        userInfo.innerHTML = `
            <a href="login.html" class="button">로그인</a>
        `;
    }
}

// 로그아웃 함수
function logout() {
    if (confirm('로그아웃 하시겠습니까?')) {
        sessionStorage.removeItem('username');
        sessionStorage.removeItem('user_id');
        location.href = 'reviews.html';
    }
}

// 페이지 로드 시 로그인 상태 업데이트
document.addEventListener('DOMContentLoaded', updateLoginStatus);