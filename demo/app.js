/* Perpustakaan DEMO — frontend-only, data di localStorage. */
const LS_KEY = "perpustakaan_demo_v1";

const SEED = {
  categories: [
    { id: 1, name: "Fiksi", description: "Buku fiksi dan novel" },
    { id: 2, name: "Non-Fiksi", description: "Buku non-fiksi dan referensi" },
    { id: 3, name: "Sains & Teknologi", description: "Buku sains, teknologi, dan komputer" },
    { id: 4, name: "Sejarah", description: "Buku sejarah dan biografi" },
    { id: 5, name: "Pendidikan", description: "Buku pendidikan dan pelajaran" },
    { id: 6, name: "Agama", description: "Buku agama dan spiritual" },
    { id: 7, name: "Anak-anak", description: "Buku cerita anak-anak" },
  ],
  books: [
    { id: 1, title: "Laskar Pelangi", author: "Andrea Hirata", isbn: "9789793062791", description: "Kisah persahabatan anak-anak di Belitung", quantity: 5, available: 5, published_year: 2005, publisher: "Bentang Pustaka", category_id: 1 },
    { id: 2, title: "Bumi Manusia", author: "Pramoedya Ananta Toer", isbn: "9789799731231", description: "Novel sejarah tentang masa kolonial", quantity: 3, available: 3, published_year: 1980, publisher: "Hasta Mitra", category_id: 1 },
    { id: 3, title: "Filosofi Teras", author: "Henry Manampiring", isbn: "9786024248106", description: "Filsafat Stoa untuk kehidupan modern", quantity: 4, available: 4, published_year: 2018, publisher: "Kompas", category_id: 2 },
    { id: 4, title: "Sapiens", author: "Yuval Noah Harari", isbn: "9780099590089", description: "Riwayat singkat umat manusia", quantity: 2, available: 2, published_year: 2014, publisher: "Harvill Secker", category_id: 4 },
  ],
  members: [
    { id: 1, name: "Ahmad Santoso", email: "ahmad.santoso@email.com", phone: "081234567890", address: "Jl. Merdeka No. 123, Jakarta", join_date: "2023-01-15", status: "active" },
    { id: 2, name: "Siti Rahayu", email: "siti.rahayu@email.com", phone: "081298765432", address: "Jl. Sudirman No. 45, Bandung", join_date: "2023-03-20", status: "active" },
    { id: 3, name: "Budi Pratama", email: "budi.pratama@email.com", phone: "081112223344", address: "Jl. Gatot Subroto No. 67, Surabaya", join_date: "2022-11-10", status: "inactive" },
  ],
  borrows: [
    { id: 1, book_id: 1, member_id: 1, borrow_date: daysAgo(2), due_date: daysAhead(5), return_date: null, status: "borrowed", notes: "" },
    { id: 2, book_id: 2, member_id: 2, borrow_date: daysAgo(20), due_date: daysAgo(6), return_date: null, status: "borrowed", notes: "" },
    { id: 3, book_id: 3, member_id: 1, borrow_date: daysAgo(30), due_date: daysAgo(16), return_date: daysAgo(15), status: "returned", notes: "" },
  ],
  seq: { book: 5, category: 8, member: 4, borrow: 4 },
};

function daysAgo(n) { const d = new Date(); d.setDate(d.getDate() - n); return d.toISOString().slice(0, 10); }
function daysAhead(n) { const d = new Date(); d.setDate(d.getDate() + n); return d.toISOString().slice(0, 10); }

/* ---------- store ---------- */
let DB;
function load() {
  try {
    const raw = localStorage.getItem(LS_KEY);
    if (raw) { DB = JSON.parse(raw); return; }
  } catch (e) {}
  DB = JSON.parse(JSON.stringify(SEED));
  // sinkronkan stok dengan peminjaman aktif
  DB.books.forEach(b => {
    const active = DB.borrows.filter(x => x.book_id === b.id && x.status !== "returned").length;
    b.available = Math.max(0, b.quantity - active);
  });
  save();
}
function save() { localStorage.setItem(LS_KEY, JSON.stringify(DB)); }
function resetDemo() {
  if (!confirm("Reset semua data demo ke awal?")) return;
  localStorage.removeItem(LS_KEY);
  load(); location.hash = "#/"; render();
}

/* ---------- helpers ---------- */
const $ = (s) => document.querySelector(s);
const esc = (s) => String(s ?? "").replace(/[&<>"']/g, (c) => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c]));
const catName = (id) => (DB.categories.find((c) => c.id === id) || {}).name || "-";
const bookOf = (id) => DB.books.find((b) => b.id === id) || {};
const memberOf = (id) => DB.members.find((m) => m.id === id) || {};
const isOverdue = (br) => br.status === "borrowed" && br.due_date < daysAhead(0);
const activeBorrowsOf = (bookId) => DB.borrows.filter((x) => x.book_id === bookId && x.status !== "returned").length;

function fmtDate(iso) {
  if (!iso) return "-";
  const d = new Date(iso + "T00:00:00");
  return d.toLocaleDateString("id-ID", { day: "numeric", month: "short", year: "numeric" });
}
function statusBadge(br) {
  if (isOverdue(br)) return `<span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-200 text-red-900 border border-red-900">Terlambat</span>`;
  if (br.status === "borrowed") return `<span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-200 text-yellow-900 border border-yellow-900">Dipinjam</span>`;
  return `<span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-200 text-green-900 border border-green-900">Dikembalikan</span>`;
}
function dueCell(br) {
  const cls = br.status !== "returned" && br.due_date < daysAhead(0) ? "text-red-600 font-semibold" : "";
  return `<div class="${cls}">${fmtDate(br.due_date)}</div>`;
}
function toast(msg, ok = true) {
  const el = document.createElement("div");
  el.className = `fixed top-16 right-4 z-50 px-4 py-3 rounded font-medium border-2 border-black nb ${ok ? "bg-green-200" : "bg-red-200"}`;
  el.textContent = msg;
  document.body.appendChild(el);
  setTimeout(() => el.remove(), 2500);
}
const btn = (href, label, color) =>
  `<a href="${href}" class="nb-btn ${color} px-3 py-1 rounded text-sm font-medium inline-block">${label}</a>`;

/* ---------- views ---------- */
function vDashboard() {
  const active = DB.borrows.filter((b) => b.status !== "returned");
  const overdue = active.filter((b) => b.due_date < daysAhead(0));
  const recent = [...active].sort((a, b) => b.borrow_date.localeCompare(a.borrow_date)).slice(0, 5);
  const card = (label, val, color) => `
    <div class="bg-white nb rounded-lg p-6">
      <div class="flex items-center">
        <div class="p-3 rounded-md ${color} border-2 border-black font-bold text-xl">${val}</div>
        <p class="ml-4 text-sm font-medium text-gray-600">${label}</p>
      </div>
    </div>`;
  return `
    <h1 class="text-2xl font-bold mb-6">Dashboard Perpustakaan</h1>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
      ${card("Total Buku", DB.books.length, "bg-purple-300")}
      ${card("Anggota Aktif", DB.members.filter((m) => m.status === "active").length, "bg-green-300")}
      ${card("Peminjaman Aktif", active.length, "bg-yellow-300")}
      ${card("Terlambat", overdue.length, "bg-red-300")}
    </div>
    <div class="bg-white nb rounded-lg overflow-hidden">
      <div class="px-6 py-4 border-b-2 border-black font-bold">Peminjaman Terbaru</div>
      <table class="min-w-full text-sm">
        <thead class="bg-gray-100 border-b-2 border-black"><tr>
          <th class="px-6 py-3 text-left">Buku</th><th class="px-6 py-3 text-left">Anggota</th>
          <th class="px-6 py-3 text-left">Jatuh Tempo</th><th class="px-6 py-3 text-left">Status</th>
        </tr></thead>
        <tbody>${recent.map((br) => `
          <tr class="border-b border-black">
            <td class="px-6 py-3">${esc(bookOf(br.book_id).title)}</td>
            <td class="px-6 py-3">${esc(memberOf(br.member_id).name)}</td>
            <td class="px-6 py-3">${dueCell(br)}</td>
            <td class="px-6 py-3">${statusBadge(br)}</td>
          </tr>`).join("") || `<tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada peminjaman aktif.</td></tr>`}
        </tbody>
      </table>
    </div>`;
}

function vBooks(q = "") {
  const query = q.toLowerCase();
  const list = DB.books
    .filter((b) => !query || b.title.toLowerCase().includes(query) || b.author.toLowerCase().includes(query))
    .sort((a, b) => b.id - a.id);
  return `
    <div class="mb-6 flex justify-between items-center">
      <h1 class="text-2xl font-bold">Daftar Buku</h1>
      ${btn("#/buku/tambah", "+ Tambah Buku", "bg-cyan-400 hover:bg-cyan-500")}
    </div>
    <form class="mb-6 flex gap-2" onsubmit="event.preventDefault(); location.hash='#/buku?q='+encodeURIComponent(this.search.value)">
      <input name="search" value="${esc(q)}" placeholder="Cari judul atau pengarang…"
        class="flex-1 nb-input rounded-md px-4 py-2 bg-white" />
      <button class="nb-btn bg-cyan-400 hover:bg-cyan-500 px-4 py-2 rounded-md font-medium">Cari</button>
      ${q ? `<a href="#/buku" class="nb-btn bg-white px-4 py-2 rounded-md font-medium inline-flex items-center">Reset</a>` : ""}
    </form>
    <div class="bg-white nb rounded-lg overflow-hidden"><div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-gray-100 border-b-2 border-black"><tr>
          <th class="px-6 py-3 text-left">Judul</th><th class="px-6 py-3 text-left">Pengarang</th>
          <th class="px-6 py-3 text-left">Kategori</th><th class="px-6 py-3 text-left">Stok</th>
          <th class="px-6 py-3 text-left">Tersedia</th><th class="px-6 py-3 text-left">Aksi</th>
        </tr></thead>
        <tbody>${list.map((b) => `
          <tr class="border-b border-black">
            <td class="px-6 py-3">${esc(b.title)}</td>
            <td class="px-6 py-3">${esc(b.author)}</td>
            <td class="px-6 py-3">${esc(catName(b.category_id))}</td>
            <td class="px-6 py-3">${b.quantity}</td>
            <td class="px-6 py-3">${b.available}</td>
            <td class="px-6 py-3 flex gap-2">
              ${btn("#/buku/" + b.id, "Lihat", "bg-blue-300 hover:bg-blue-400")}
              ${btn("#/buku/" + b.id + "/edit", "Edit", "bg-yellow-300 hover:bg-yellow-400")}
              <button onclick="delBook(${b.id})" class="nb-btn bg-red-300 hover:bg-red-400 px-3 py-1 rounded text-sm font-medium">Hapus</button>
            </td>
          </tr>`).join("") || `<tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data buku.</td></tr>`}
        </tbody>
      </table>
    </div></div>`;
}

function vBookForm(id) {
  const b = id ? DB.books.find((x) => x.id === Number(id)) : null;
  if (id && !b) return `<p>Buku tidak ditemukan.</p>`;
  const v = (k) => esc(b ? b[k] : "");
  const catOpts = DB.categories.map((c) =>
    `<option value="${c.id}" ${b && b.category_id === c.id ? "selected" : ""}>${esc(c.name)}</option>`).join("");
  return `
    <h1 class="text-2xl font-bold mb-6">${b ? "Edit Buku" : "Tambah Buku"}</h1>
    <form class="bg-white nb rounded-lg p-6 max-w-2xl space-y-4" onsubmit="saveBook(event, ${b ? b.id : "null"})">
      ${field("Judul", "title", v("title"), true)}
      ${field("Pengarang", "author", v("author"), true)}
      <div><label class="font-medium text-sm">Kategori</label>
        <select name="category_id" class="w-full nb-input rounded-md px-3 py-2 bg-white mt-1">${catOpts}</select></div>
      ${field("ISBN", "isbn", v("isbn"))}
      ${field("Penerbit", "publisher", v("publisher"))}
      ${field("Tahun Terbit", "published_year", v("published_year"), false, "number")}
      ${field("Jumlah (stok)", "quantity", b ? b.quantity : 1, true, "number")}
      <div><label class="font-medium text-sm">Deskripsi</label>
        <textarea name="description" rows="3" class="w-full nb-input rounded-md px-3 py-2 bg-white mt-1">${v("description")}</textarea></div>
      <div class="flex gap-2">
        <button class="nb-btn bg-cyan-400 hover:bg-cyan-500 px-4 py-2 rounded-md font-medium">Simpan</button>
        <a href="#/buku" class="nb-btn bg-white px-4 py-2 rounded-md font-medium inline-flex items-center">Batal</a>
      </div>
    </form>`;
}
function field(label, name, val, req = false, type = "text") {
  return `<div><label class="font-medium text-sm">${label}${req ? " *" : ""}</label>
    <input name="${name}" type="${type}" value="${val}" ${req ? "required" : ""} min="0"
      class="w-full nb-input rounded-md px-3 py-2 bg-white mt-1" /></div>`;
}
function saveBook(e, id) {
  e.preventDefault();
  const f = Object.fromEntries(new FormData(e.target).entries());
  f.quantity = Math.max(0, parseInt(f.quantity) || 0);
  f.category_id = parseInt(f.category_id);
  f.published_year = f.published_year ? parseInt(f.published_year) : null;
  if (id) {
    const b = DB.books.find((x) => x.id === id);
    const act = activeBorrowsOf(id);
    if (f.quantity < act) { toast(`Stok tidak boleh < peminjaman aktif (${act}).`, false); return; }
    Object.assign(b, f);
    b.available = Math.max(0, b.quantity - act);
    toast("Buku berhasil diupdate.");
  } else {
    const nb = { id: DB.seq.book++, available: f.quantity, ...f };
    DB.books.push(nb);
    toast("Buku berhasil ditambahkan.");
  }
  save(); location.hash = "#/buku"; render();
}
function delBook(id) {
  if (activeBorrowsOf(id) > 0) { toast("Buku dengan peminjaman aktif tidak boleh dihapus.", false); return; }
  if (!confirm("Hapus buku ini?")) return;
  DB.books = DB.books.filter((b) => b.id !== id);
  save(); toast("Buku berhasil dihapus."); render();
}
function vBookDetail(id) {
  const b = DB.books.find((x) => x.id === Number(id));
  if (!b) return `<p>Buku tidak ditemukan.</p>`;
  const row = (l, val) => `<div class="flex border-b border-gray-200 py-2"><dt class="w-40 font-medium text-gray-600">${l}</dt><dd>${val}</dd></div>`;
  return `
    <h1 class="text-2xl font-bold mb-6">${esc(b.title)}</h1>
    <div class="bg-white nb rounded-lg p-6 max-w-2xl">
      <dl class="text-sm">
        ${row("Pengarang", esc(b.author))}${row("Kategori", esc(catName(b.category_id)))}
        ${row("ISBN", esc(b.isbn) || "-")}${row("Penerbit", esc(b.publisher) || "-")}
        ${row("Tahun", b.published_year || "-")}${row("Stok", b.quantity)}${row("Tersedia", b.available)}
        ${row("Deskripsi", esc(b.description) || "-")}
      </dl>
      <div class="flex gap-2 mt-6">
        ${btn("#/buku/" + b.id + "/edit", "Edit", "bg-yellow-300 hover:bg-yellow-400")}
        <a href="#/buku" class="nb-btn bg-white px-4 py-2 rounded-md font-medium inline-flex items-center">Kembali</a>
      </div>
    </div>`;
}

function vMembers() {
  return `
    <div class="mb-6 flex justify-between items-center">
      <h1 class="text-2xl font-bold">Daftar Anggota</h1>
      ${btn("#/anggota/tambah", "+ Tambah Anggota", "bg-cyan-400 hover:bg-cyan-500")}
    </div>
    <div class="bg-white nb rounded-lg overflow-hidden"><div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-gray-100 border-b-2 border-black"><tr>
          <th class="px-6 py-3 text-left">Nama</th><th class="px-6 py-3 text-left">Email</th>
          <th class="px-6 py-3 text-left">Telepon</th><th class="px-6 py-3 text-left">Status</th><th class="px-6 py-3 text-left">Aksi</th>
        </tr></thead>
        <tbody>${DB.members.map((m) => `
          <tr class="border-b border-black">
            <td class="px-6 py-3">${esc(m.name)}</td><td class="px-6 py-3">${esc(m.email)}</td>
            <td class="px-6 py-3">${esc(m.phone)}</td>
            <td class="px-6 py-3">${m.status === "active"
              ? `<span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-200 text-green-900 border border-green-900">Aktif</span>`
              : `<span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-gray-900 border border-gray-900">Nonaktif</span>`}</td>
            <td class="px-6 py-3 flex gap-2">
              ${btn("#/anggota/" + m.id + "/edit", "Edit", "bg-yellow-300 hover:bg-yellow-400")}
              <button onclick="delMember(${m.id})" class="nb-btn bg-red-300 hover:bg-red-400 px-3 py-1 rounded text-sm font-medium">Hapus</button>
            </td>
          </tr>`).join("") || `<tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data anggota.</td></tr>`}
        </tbody>
      </table>
    </div></div>`;
}
function vMemberForm(id) {
  const m = id ? DB.members.find((x) => x.id === Number(id)) : null;
  if (id && !m) return `<p>Anggota tidak ditemukan.</p>`;
  const v = (k) => esc(m ? m[k] : "");
  return `
    <h1 class="text-2xl font-bold mb-6">${m ? "Edit Anggota" : "Tambah Anggota"}</h1>
    <form class="bg-white nb rounded-lg p-6 max-w-2xl space-y-4" onsubmit="saveMember(event, ${m ? m.id : "null"})">
      ${field("Nama", "name", v("name"), true)}
      ${field("Email", "email", v("email"), true, "email")}
      ${field("Telepon", "phone", v("phone"))}
      ${field("Alamat", "address", v("address"))}
      ${field("Tanggal Bergabung", "join_date", v("join_date") || daysAhead(0), true, "date")}
      <div><label class="font-medium text-sm">Status</label>
        <select name="status" class="w-full nb-input rounded-md px-3 py-2 bg-white mt-1">
          <option value="active" ${m && m.status === "active" ? "selected" : ""}>Aktif</option>
          <option value="inactive" ${m && m.status === "inactive" ? "selected" : ""}>Nonaktif</option>
        </select></div>
      <div class="flex gap-2">
        <button class="nb-btn bg-cyan-400 hover:bg-cyan-500 px-4 py-2 rounded-md font-medium">Simpan</button>
        <a href="#/anggota" class="nb-btn bg-white px-4 py-2 rounded-md font-medium inline-flex items-center">Batal</a>
      </div>
    </form>`;
}
function saveMember(e, id) {
  e.preventDefault();
  const f = Object.fromEntries(new FormData(e.target).entries());
  if (id) { Object.assign(DB.members.find((x) => x.id === id), f); toast("Anggota berhasil diupdate."); }
  else { DB.members.push({ id: DB.seq.member++, ...f }); toast("Anggota berhasil ditambahkan."); }
  save(); location.hash = "#/anggota"; render();
}
function delMember(id) {
  if (DB.borrows.some((x) => x.member_id === id && x.status !== "returned")) { toast("Anggota dengan peminjaman aktif tidak boleh dihapus.", false); return; }
  if (!confirm("Hapus anggota ini?")) return;
  DB.members = DB.members.filter((m) => m.id !== id);
  save(); toast("Anggota berhasil dihapus."); render();
}

function vBorrows() {
  const list = [...DB.borrows].sort((a, b) => b.id - a.id);
  return `
    <div class="mb-6 flex justify-between items-center">
      <h1 class="text-2xl font-bold">Daftar Peminjaman</h1>
      ${btn("#/peminjaman/tambah", "+ Catat Peminjaman", "bg-cyan-400 hover:bg-cyan-500")}
    </div>
    <div class="bg-white nb rounded-lg overflow-hidden"><div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-gray-100 border-b-2 border-black"><tr>
          <th class="px-6 py-3 text-left">Buku</th><th class="px-6 py-3 text-left">Anggota</th>
          <th class="px-6 py-3 text-left">Tgl Pinjam</th><th class="px-6 py-3 text-left">Jatuh Tempo</th>
          <th class="px-6 py-3 text-left">Status</th><th class="px-6 py-3 text-left">Aksi</th>
        </tr></thead>
        <tbody>${list.map((br) => `
          <tr class="border-b border-black">
            <td class="px-6 py-3">${esc(bookOf(br.book_id).title)}</td>
            <td class="px-6 py-3">${esc(memberOf(br.member_id).name)}</td>
            <td class="px-6 py-3">${fmtDate(br.borrow_date)}</td>
            <td class="px-6 py-3">${dueCell(br)}</td>
            <td class="px-6 py-3">${statusBadge(br)}</td>
            <td class="px-6 py-3">
              ${br.status === "borrowed" ? `<button onclick="returnBook(${br.id})" class="nb-btn bg-green-300 hover:bg-green-400 px-3 py-1 rounded text-sm font-medium">Kembalikan</button>` : `<span class="text-gray-400 text-sm">-</span>`}
            </td>
          </tr>`).join("") || `<tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data peminjaman.</td></tr>`}
        </tbody>
      </table>
    </div></div>`;
}
function vBorrowForm() {
  const bookOpts = DB.books.filter((b) => b.available > 0).map((b) =>
    `<option value="${b.id}">${esc(b.title)} (tersedia: ${b.available})</option>`).join("");
  const memberOpts = DB.members.filter((m) => m.status === "active").map((m) =>
    `<option value="${m.id}">${esc(m.name)}</option>`).join("");
  if (!bookOpts || !memberOpts) return `<p class="bg-yellow-100 nb rounded p-4">Tidak bisa mencatat peminjaman: butuh buku yang tersedia dan anggota aktif.</p>`;
  return `
    <h1 class="text-2xl font-bold mb-6">Catat Peminjaman</h1>
    <form class="bg-white nb rounded-lg p-6 max-w-2xl space-y-4" onsubmit="saveBorrow(event)">
      <div><label class="font-medium text-sm">Buku *</label>
        <select name="book_id" required class="w-full nb-input rounded-md px-3 py-2 bg-white mt-1">${bookOpts}</select></div>
      <div><label class="font-medium text-sm">Anggota *</label>
        <select name="member_id" required class="w-full nb-input rounded-md px-3 py-2 bg-white mt-1">${memberOpts}</select></div>
      ${field("Tanggal Pinjam", "borrow_date", daysAhead(0), true, "date")}
      ${field("Jatuh Tempo", "due_date", daysAhead(7), true, "date")}
      <div><label class="font-medium text-sm">Catatan</label>
        <textarea name="notes" rows="2" class="w-full nb-input rounded-md px-3 py-2 bg-white mt-1"></textarea></div>
      <div class="flex gap-2">
        <button class="nb-btn bg-cyan-400 hover:bg-cyan-500 px-4 py-2 rounded-md font-medium">Simpan</button>
        <a href="#/peminjaman" class="nb-btn bg-white px-4 py-2 rounded-md font-medium inline-flex items-center">Batal</a>
      </div>
    </form>`;
}
function saveBorrow(e) {
  e.preventDefault();
  const f = Object.fromEntries(new FormData(e.target).entries());
  const book = DB.books.find((b) => b.id === parseInt(f.book_id));
  if (!book || book.available <= 0) { toast("Buku tidak tersedia.", false); return; }
  DB.borrows.push({
    id: DB.seq.borrow++, book_id: book.id, member_id: parseInt(f.member_id),
    borrow_date: f.borrow_date, due_date: f.due_date, return_date: null,
    status: "borrowed", notes: f.notes || "",
  });
  book.available--;
  save(); toast("Peminjaman berhasil dicatat."); location.hash = "#/peminjaman"; render();
}
function returnBook(id) {
  const br = DB.borrows.find((x) => x.id === id);
  if (!br || br.status !== "borrowed") return;
  if (!confirm("Tandai buku ini sudah dikembalikan?")) return;
  br.status = "returned";
  br.return_date = daysAhead(0);
  const book = bookOf(br.book_id);
  if (book.id) book.available = Math.min(book.quantity, book.available + 1);
  save(); toast("Buku berhasil dikembalikan."); render();
}

function vCategories() {
  return `
    <div class="mb-6"><h1 class="text-2xl font-bold">Kategori Buku</h1></div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
      ${DB.categories.map((c) => `
        <div class="bg-white nb rounded-lg p-5">
          <h3 class="font-bold">${esc(c.name)}</h3>
          <p class="text-sm text-gray-600 mt-1">${esc(c.description)}</p>
          <p class="text-xs text-gray-400 mt-2">${DB.books.filter((b) => b.category_id === c.id).length} buku</p>
        </div>`).join("")}
    </div>`;
}

/* ---------- router ---------- */
function render() {
  const hash = location.hash || "#/";
  const [path, query] = hash.slice(2).split("?");
  const params = new URLSearchParams(query || "");
  const view = $("#view");
  document.querySelectorAll(".nav-link").forEach((a) => {
    const key = a.dataset.nav;
    a.classList.toggle("active", (path === "" && key === "dashboard") || path.startsWith(key));
  });
  let html;
  if (path === "" || path === "/") html = vDashboard();
  else if (path === "buku") html = vBooks(params.get("q") || "");
  else if (path === "buku/tambah") html = vBookForm(null);
  else if (/^buku\/\d+\/edit$/.test(path)) html = vBookForm(path.split("/")[1]);
  else if (/^buku\/\d+$/.test(path)) html = vBookDetail(path.split("/")[1]);
  else if (path === "anggota") html = vMembers();
  else if (path === "anggota/tambah") html = vMemberForm(null);
  else if (/^anggota\/\d+\/edit$/.test(path)) html = vMemberForm(path.split("/")[1]);
  else if (path === "peminjaman") html = vBorrows();
  else if (path === "peminjaman/tambah") html = vBorrowForm();
  else if (path === "kategori") html = vCategories();
  else html = `<p>Halaman tidak ditemukan.</p><a href="#/" class="underline">Kembali ke dashboard</a>`;
  view.innerHTML = html;
  window.scrollTo(0, 0);
}

load();
window.addEventListener("hashchange", render);
render();
