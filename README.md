# Dev MAHABOB — PHP Website + Separate Admin Website

devyasin.online-এর ধাঁচে বানানো: ফ্রি রিসোর্স / প্রজেক্ট কার্ড ওয়েবসাইট, PHP দিয়ে।

## গঠন
- `index.php` — মূল পাবলিক ওয়েবসাইট (হোম, সার্চ, ক্যাটাগরি ফিল্টার, Weather, Connect)
- `admin/` — **আলাদা অ্যাডমিন ওয়েবসাইট** (লগইনসহ ড্যাশবোর্ড)
  - `admin/login.php` — লগইন
  - `admin/index.php` — ড্যাশবোর্ড, প্রজেক্ট লিস্ট
  - `admin/edit.php` — প্রজেক্ট Add / Edit
  - `admin/delete.php` — প্রজেক্ট Delete
- `data/projects.json` — সব প্রজেক্টের ডেটা (ডাটাবেস লাগবে না, যেকোনো PHP হোস্টিংয়ে চলবে)
- `config.php` — সাইটের নাম, সোশ্যাল লিংক, অ্যাডমিন পাসওয়ার্ড

## অ্যাডমিন লগইন
- Username: `admin`
- Password: `admin123`
- ⚠️ প্রথম লগইনের পরপরই পাসওয়ার্ড বদলাও:
  1. ব্রাউজারে খোলো `admin/make_hash.php?pw=তোমারনতুনপাসওয়ার্ড`
  2. পাওয়া হ্যাশটা `config.php`-তে `admin_pass_hash`-এ বসাও
  3. `admin/make_hash.php` ফাইলটা ডিলিট করে দাও

## হোস্টিংয়ে আপলোড (যেকোনো ফ্রি/পেইড PHP হোস্টিং — InfinityFree, 000webhost, cPanel ইত্যাদি)
1. এই ফোল্ডারের সব ফাইল ZIP করে হোস্টিংয়ের `public_html` / `htdocs`-এ আপলোড করে extract করো
2. মূল সাইট চলবে: `https://তোমারডোমেইন.com/`
3. অ্যাডমিন সাইট চলবে: `https://তোমারডোমেইন.com/admin/`
4. চাইলে অ্যাডমিনকে পুরোপুরি আলাদা সাবডোমেইন করতে পারো: হোস্টিংয়ে `admin.তোমারডোমেইন.com` সাবডোমেইন বানিয়ে তার ফোল্ডার হিসেবে এই `admin` ফোল্ডারটা দেখিয়ে দাও — তবে তখন `data` আর `lib` ফোল্ডারও সেখানে কপি রাখতে হবে।
5. `data` ফোল্ডারে write permission দাও (755/775), যাতে অ্যাডমিন থেকে প্রজেক্ট সেভ হয়।

## লোকালি চালানো
```
php -S localhost:8000
```
তারপর ব্রাউজারে: http://localhost:8000 এবং http://localhost:8000/admin/
