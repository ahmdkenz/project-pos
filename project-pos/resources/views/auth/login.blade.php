<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mustika Komputer</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* * ======================================
         * CSS (Semua dalam satu file)
         * ======================================
         */

        /* --- 1. Reset & Latar Belakang Global --- */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

        /* --- 2. Kartu Login (Form Container) --- */
        .login-container {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 450px;
            text-align: center;
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- 3. Header Form (Judul) --- */
        .login-header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.5rem;
        }
        .login-header p {
            color: #718096;
            font-size: 0.9rem;
            margin-bottom: 1.5rem; /* Beri sedikit ruang untuk error */
        }

        /* --- 4. Grup Input (Label & Textbox) --- */
        .form-group {
            margin-bottom: 1.25rem;
            text-align: left;
        }
        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 0.5rem;
        }
        .form-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            border: 1px solid #e2e8f0; 
            border-radius: 8px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-group input:focus {
            outline: none;
            border-color: #4F46E5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2); 
        }

        /* --- 5. Opsi Tambahan (Lupa Password) --- */
        .form-options {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 1.5rem;
        }
        .form-options a {
            color: #4F46E5;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.3s;
        }
        .form-options a:hover { color: #3B82F6; }

        /* --- 6. Tombol CTA (Call to Action) Modern --- */
        .cta-button {
            width: 100%;
            padding: 0.85rem 1rem;
            border: none;
            border-radius: 8px;
            background-image: linear-gradient(90deg, #4F46E5, #3B82F6);
            color: #ffffff;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        }
        .cta-button:active { transform: translateY(0); }

        
        /* * ======================================
         * [MIGRASI] CSS UNTUK ERROR LARAVEL
         * ======================================
         */

        /* Blok untuk error umum (misal: "Password salah") */
        .auth-errors {
            background-color: #FEE2E2; /* Latar merah muda */
            color: #9B2C2C; /* Teks merah tua */
            border: 1px solid #EF4444;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            text-align: left;
            font-size: 0.9rem;
        }
        .auth-errors ul {
            list-style-position: inside;
        }
        
        /* Pesan error di bawah input */
        .error-message {
            color: #EF4444;
            font-size: 0.875rem;
            font-weight: 500;
            margin-top: 0.5rem;
        }
        
        /* Memberi border merah pada input yang error */
        .input-error {
            border-color: #EF4444 !important;
        }
        .input-error:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2) !important;
        }

    </style>
</head>
<body>

    <div class="login-container">
        
        <div class="login-header">
            <h2>Selamat Datang</h2>
            <p>Silakan masuk untuk melanjutkan ke aplikasi Anda.</p>
        </div>
        
        @if ($errors->any())
            <div class="auth-errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        
        <form method="POST" action="{{ route('login') }}">
            
            @csrf

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"  {{-- 2. Tampilkan email lama jika login gagal --}}
                    required 
                    autofocus
                    class="@error('email') input-error @enderror" {{-- 3. Tambah class jika error --}}
                >
                
                {{-- 4. Tampilkan pesan error validasi email --}}
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password"
                    required
                    class="@error('password') input-error @enderror"
                >
                
                {{-- 5. Tampilkan pesan error validasi password --}}
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-options">
                <a href="{{ route('password.request') }}"> {{-- 6. Ganti link ke route Laravel --}}
                    Lupa Password?
                </a>
            </div>
            
            <button type="submit" class="cta-button">
                Masuk
            </button>
            
        </form>
        
    </div>

</body>
</html>