# 📘 Book Application - Pseudocode

Berikut adalah **pseudocode lengkap** berdasarkan use case dan scenario dari aplikasi *Book Application*.

---

## 🔐 1. Login

```plaintext
FUNCTION login(email, password):
    user = DATABASE.findUserByEmail(email)
    IF user IS NOT NULL AND user.password == password THEN
        RETURN "Login Successful", user
    ELSE
        RETURN "Invalid Email or Password"
```

---

## 📝 2. Register

```plaintext
FUNCTION register(name, email, password):
    IF name IS EMPTY OR email IS EMPTY OR password IS EMPTY THEN
        RETURN "Form tidak boleh kosong"

    IF NOT validateEmailFormat(email) THEN
        RETURN "Format email tidak sesuai"

    userExists = DATABASE.findUserByEmail(email)
    IF userExists IS NOT NULL THEN
        RETURN "Email sudah digunakan"

    newUser = CREATE User(name, email, password, role="User")
    DATABASE.save(newUser)
    RETURN "Registrasi berhasil"
```

---

## 📚 3. View Books (User & Admin)

```plaintext
FUNCTION viewBooks():
    books = DATABASE.getAllBooks()
    RETURN books
```

---

## 🛠️ 4. Create Book (Admin Only)

```plaintext
FUNCTION createBook(user, title, author, year, category):
    IF user.role != "Admin" THEN
        RETURN "Access Denied"

    IF title IS EMPTY OR author IS EMPTY OR year IS EMPTY THEN
        RETURN "Data tidak boleh kosong"

    newBook = CREATE Book(title, author, year, category)
    DATABASE.save(newBook)
    RETURN "Buku berhasil ditambahkan"
```

---

## ✏️ 5. Update Book (Admin Only)

```plaintext
FUNCTION updateBook(user, bookId, newTitle, newAuthor, newYear, newCategory):
    IF user.role != "Admin" THEN
        RETURN "Access Denied"

    book = DATABASE.findBookById(bookId)
    IF book IS NULL THEN
        RETURN "Buku tidak ditemukan"

    book.title = newTitle
    book.author = newAuthor
    book.year = newYear
    book.category = newCategory
    DATABASE.update(book)
    RETURN "Buku berhasil diperbarui"
```

---

## 🗑️ 6. Delete Book (Admin Only)

```plaintext
FUNCTION deleteBook(user, bookId):
    IF user.role != "Admin" THEN
        RETURN "Access Denied"

    book = DATABASE.findBookById(bookId)
    IF book IS NULL THEN
        RETURN "Buku tidak ditemukan"

    DATABASE.delete(bookId)
    RETURN "Buku berhasil dihapus"
```

---

## ⚠️ 7. Aliran Alternatif: Validasi Input

### a. Email Sudah Terdaftar

```plaintext
IF DATABASE.findUserByEmail(email) IS NOT NULL THEN
    RETURN "Email sudah digunakan"
```

### b. Form Tidak Lengkap

```plaintext
IF name IS EMPTY OR email IS EMPTY OR password IS EMPTY THEN
    RETURN "Data tidak boleh kosong"
```

### c. Format Tidak Sesuai

```plaintext
IF NOT validateEmailFormat(email) THEN
    RETURN "Format email tidak valid"
```

---
