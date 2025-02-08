// @ts-check
const { test, expect } = require('@playwright/test');
import axios from 'axios';
import xlsx from 'node-xlsx';
const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
// url login -> npx playwright codegen --save-storage=auth.json bos.polri.go.id

const users = {
  // rajadesa
  'rajadesaDodi': {
    'kecamatan': 'Rajadesa',
    'desa': 'Sirnajaya',
    'nrp': '01020191',
    'password': '01019191'
  },
  'rajadesaRony': {
    'kecamatan': 'Rajadesa',
    'desa': 'Tanjungsari',
    'nrp': '84121472',
    'password': '84121472',
  },
  'rajadesaBadai': {
    'kecamatan': 'Rajadesa',
    'desa': 'Sukaharja',
    'nrp': '86090139',
    'password': '86090139',
  },
  'rajadesaPandji': {
    'kecamatan': 'Rajadesa',
    'desa': 'Sirnabaya',
    'nrp': '83091356',
    'password': '83091356',
  },
  // panjalu
  'panjaluYadi': {
    'kecamatan': 'Panjalu',
    'desa': 'Sandingtaman',
    'nrp': '81051123',
    'password': '81051123'
  },
  'panjaluMulia': {
    'kecamatan': 'Sukamantri',
    'desa': 'Sukamantri',
    'nrp': '88080845',
    'password': '88080845'
  },
  'panjaluCacan': {
    'kecamatan': 'Panjalu',
    'desa': 'Ciomas',
    'nrp': '85101363',
    'password': '85101363'
  },
  'panjaluAndi': {
    'kecamatan': 'Panjalu',
    'desa': 'Kertamandala',
    'nrp': '84070569',
    'password': 'bharaduta23bep'
  },
  
  // cisaga
  'cisagaPanca': {
    'kecamatan': 'Cisaga',
    'desa': 'Mekarmukti',
    'nrp': '83100639',
    'password': '05101983'
  },
  'cisagaAlimukti': {
    'kecamatan': 'Cisaga',
    'desa': 'Tanjungjaya',
    'nrp': '84110454',
    'password': '01111984'
  },
  'cisagaDikdik': {
    'kecamatan': 'Cisaga',
    'desa': 'Sukahurip',
    'nrp': '81011237',
    'password': '31011981'
  },
  'cisagaRapi': {
    'kecamatan': 'Cisaga',
    'desa': 'Sidamulya',
    'nrp': '85031549',
    'password': '09031985'
  },

  // sukadana 
  'sukadanaEel': {
    'kecamatan': 'Sukadana',
    'desa': 'Salakaria',
    'nrp': '92110756',
    'password': '92110756'
  },
  'sukadanaSugandi': {
    'kecamatan': 'Sukadana',
    'desa': 'Sukadana',
    'nrp': '93121076',
    'password': '93121076'
  },
  'sukadanaErik': {
    'kecamatan': 'Sukadana',
    'desa': 'Bunter',
    'nrp': '88030416',
    'password': '88030416'
  }

}

let user = 'sukadanaErik';

//  do not change below
function generateString(length) {
  let result = ' ';
  const charactersLength = characters.length;
  for (let i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }

  return result;
}

let kecamatan = users[user]['kecamatan'];
let desa = users[user]['desa'];

const workSheetsFromFile = xlsx.parse('./auto/list/' + kecamatan.toLowerCase() + '/list_' + desa.toLowerCase() + '.xlsx');

test.describe('DDS', () => {
  workSheetsFromFile[0].data.forEach((value, index) => {
    if (index == 0) {
      return;
    }
    var nama = value[2]
    var provinsi = 'JAWA BARAT'
    var kabupaten = 'KABUPATEN CIAMIS'
    kecamatan = kecamatan.toUpperCase()
    var rt = value[4]
    var rw = value[5]
    var dusun = value[3]
    var uraian = value[7] + ' #' + generateString(20)
    var tanggal = value[1]
    test(`do dds ${index} ${nama}`, async ({ browser }) => {
      const context = await browser.newContext({
        storageState: './auth.json'
      });
      const page = await context.newPage();
      await page.goto('https://bos.polri.go.id/laporan/dds-warga/create');



      await page.locator('span').filter({ hasText: 'Kepala Keluarga' }).click();
      await page.getByPlaceholder('masukkan nama kepala keluarga').fill(nama);

      // fill alamat
      await page.getByLabel('Provinsi').selectOption('JAWA BARAT');
      await page.getByLabel('Kota/Kabupaten').selectOption('KABUPATEN CIAMIS');
      await page.getByLabel('Kecamatan').selectOption(kecamatan.toUpperCase());
      await page.getByLabel('Kelurahan/Desa').selectOption(desa);
      await page.getByPlaceholder('nama jalan/kampung/perumahan').fill(`Dsn. ${dusun}`);
      await page.getByPlaceholder('masukkan RT').fill(rt);
      await page.getByPlaceholder('masukkan RW').fill(rw);
      // fill alamt


      // fill catatan
      await page.locator('span').filter({ hasText: 'Catatan Kunjungan Warga' }).click();
      await page.getByLabel('Tanggal Kunjungan').fill(`${tanggal}`);


      // fill status
      await page.locator('span').filter({ hasText: 'Status Penerima Kunjungan' }).click();
      await page.getByPlaceholder('nama yang menerima kunjungan').fill(nama);
      await page.getByLabel('Status Yang Menerima Kunjungan').selectOption('kepala keluarga');


      // pendapat warga
      await page.getByRole('heading', { name: 'Pendapat Warga' }).click();
      await page.locator('#bidang-keluhan').selectOption('EKONOMI');
      await page.getByPlaceholder('uraian singkat keluhan warga').fill(uraian);
      await page.getByRole('searchbox', { name: 'Search' }).fill('ekonomi');

      await page.getByRole('searchbox', { name: 'Search' }).fill('ekonomi warga');
      await expect(page.getByRole('option', { name: 'ekonomi warga', exact: true })).toBeVisible();
      await page.getByRole('option', { name: 'ekonomi warga', exact: true }).click();

      // informasi
      await page.getByRole('heading', { name: 'Laporan Informasi' }).click();
      await page.getByLabel('Ekonomi').check();
      await page.getByPlaceholder('uraian singkat Informasi warga').fill(uraian);
      await page.getByPlaceholder('pilih keyword, atau input').fill('ekonomi');
      await expect(page.getByRole('option', { name: 'ekonomi', exact: true })).toBeVisible();
      await page.getByRole('option', { name: 'ekonomi', exact: true }).click();

      // submit
      await page.getByRole('button', { name: 'Simpan' }).click();
      try {
        // alert
        await expect(page.getByRole('button', { name: 'OK' })).toBeVisible({
          timeout: 8000
        });
      } catch (error) {
        console.log('alert not found');
      }


      await page.close();
    });
  })
})

test.describe('Deteksi dini', () => {
  workSheetsFromFile[0].data.slice(20,31).forEach((value, index) => {
    if (index == 0) {
      return;
    }
    var nama = value[2]
    var provinsi = 'JAWA BARAT'
    var kabupaten = 'KABUPATEN CIAMIS'
    kecamatan = kecamatan.toUpperCase()
    var rt = value[4]
    var rw = value[5]
    var dusun = value[3]
    var uraian = value[7] + ' #' + generateString(20)
    var tanggal = value[1]
    test(`do deteksi dini ${index} ${nama}`, async ({ browser }) => {
      const context = await browser.newContext({
        storageState: './auth.json'
      });
      const page = await context.newPage();
      await page.goto('https://bos.polri.go.id/laporan/deteksi-dini/create');
      await page.getByRole('heading', { name: 'Sumber Informasi' }).click();
      await page.getByPlaceholder('masukkan nama narasumber').fill(nama);
      await page.getByPlaceholder('masukkan pekerjaan narasumber').fill('Wiraswasta');
      await page.getByLabel('Provinsi').selectOption('JAWA BARAT');
      await page.getByLabel('Kota/Kabupaten').selectOption('KABUPATEN CIAMIS');
      await page.getByLabel('Kecamatan').selectOption(kecamatan.toUpperCase());
      await page.getByLabel('Kelurahan/Desa').selectOption(desa);
      await page.getByPlaceholder('Nama jalan/kampung/perumahan').fill(`dusun ${dusun}`);
      await page.getByPlaceholder('masukkan RT').fill('001');
      await page.getByPlaceholder('masukkan RW').fill('001');
  
      // tab 2
  
      await page.getByRole('heading', { name: 'Waktu dan Lokasi Mendapatkan' }).click();
      await page.getByLabel('Tanggal Mendapatkan Informasi').fill(tanggal);
      await page.getByLabel('Jam Mendapatkan Informasi').click();
      await page.getByLabel('Jam Mendapatkan Informasi').click();
      await page.getByLabel('Jam Mendapatkan Informasi').click();
      await page.getByLabel('Jam Mendapatkan Informasi').click();
      await page.getByLabel('Jam Mendapatkan Informasi').dblclick();
      await page.getByLabel('Jam Mendapatkan Informasi').press('ArrowUp');
      await page.getByLabel('Jam Mendapatkan Informasi').press('ArrowUp');
      await page.getByLabel('Jam Mendapatkan Informasi').press('ArrowUp');
      await page.getByLabel('Jam Mendapatkan Informasi').press('ArrowUp');
      await page.getByLabel('Jam Mendapatkan Informasi').press('ArrowUp');
      await page.getByLabel('Jam Mendapatkan Informasi').press('ArrowUp');
      await page.getByLabel('Jam Mendapatkan Informasi').press('ArrowUp');
      await page.getByLabel('Jam Mendapatkan Informasi').press('ArrowUp');
      await page.getByLabel('Jam Mendapatkan Informasi').press('ArrowUp');
      await page.getByLabel('Jam Mendapatkan Informasi').press('Tab');
      await page.getByLabel('Jam Mendapatkan Informasi').press('ArrowUp');
      await page.getByLabel('Jam Mendapatkan Informasi').press('ArrowUp');
      await page.getByLabel('Jam Mendapatkan Informasi').press('ArrowUp');
      await page.getByLabel('Jam Mendapatkan Informasi').press('ArrowUp');
      await page.getByLabel('Jam Mendapatkan Informasi').press('Tab');
      await page.getByLabel('Jam Mendapatkan Informasi').press('ArrowUp');
  
  
      await page.getByLabel('Tempat Mendapatkan Informasi').click();
      await page.getByLabel('Tempat Mendapatkan Informasi').fill('rumah pelapor');
      await page.locator('span').filter({ hasText: 'Laporan Informasi' }).click();
      await page.getByText('Ekonomi', { exact: true }).click();
      await page.getByRole('radio').nth(1).check();
      await page.getByPlaceholder('Uraian singkat informasi atau').click();
      await page.getByPlaceholder('Uraian singkat informasi atau').fill(uraian);
      await page.getByPlaceholder('pilih keyword, atau input').click();
      await page.getByPlaceholder('pilih keyword, atau input').fill('ekonomi');
      await expect(page.getByRole('option', { name: 'ekonomi', exact: true })).toBeVisible();
      await page.getByRole('option', { name: 'ekonomi', exact: true }).click();
  
  
      // submit
      await page.getByRole('button', { name: 'Simpan' }).click();
      // alert
      try {
      await expect(page.getByRole('button', { name: 'OK' })).toBeVisible();
      } catch (error) {
        console.log('alert not found');
      }
      await page.screenshot({ path: `C:/laragon/www/bosv2/auto/screenshots/deteksi_dini_${index}.png`, });
  
      await page.close();
    });
  })
});

test.describe('PS2', () => {
  workSheetsFromFile[0].data.slice(2, 7).forEach((value, index) => {
    if (index == 0) {
      return;
    }
    var nama = value[2]
    var provinsi = 'JAWA BARAT'
    var kabupaten = 'KABUPATEN CIAMIS'
    kecamatan = kecamatan.toUpperCase()
    var rt = value[4]
    var rw = value[5]
    var dusun = value[3]
    var uraian = value[7] + ' #' + generateString(20)
    var tanggal = value[1]
    test(`do ps-2 ${index} ${nama}`, async ({ browser }) => {
      const context = await browser.newContext({
        storageState: './auth.json'
      });
      const today = new Date();
      const yyyy = today.getFullYear().toString().padStart(4, '0');
      const mm = (today.getMonth() + 1).toString().padStart(2, '0');
      const dd = today.getDate().toString().padStart(2, '0');
      const dateToday = `${yyyy}-${mm}-${dd}`;
      const page = await context.newPage();
      await page.goto('https://bos.polri.go.id/laporan/problem-solving/non-sengketa/create');
      await page.getByRole('heading', { name: 'Laporan Permasalahan' }).click();
      await page.getByLabel('Tanggal Permasalahan Diterima').fill(dateToday);
      await page.getByLabel('Waktu Permasalahan Diterima').click();
      await page.getByLabel('Waktu Permasalahan Diterima').press('ArrowUp');
      await page.getByLabel('Waktu Permasalahan Diterima').press('ArrowUp');
      await page.getByLabel('Waktu Permasalahan Diterima').press('ArrowUp');
      await page.getByLabel('Waktu Permasalahan Diterima').press('ArrowUp');
      await page.getByLabel('Waktu Permasalahan Diterima').press('ArrowUp');
      await page.getByLabel('Waktu Permasalahan Diterima').press('ArrowUp');
      await page.getByLabel('Waktu Permasalahan Diterima').press('ArrowUp');
      await page.getByLabel('Waktu Permasalahan Diterima').press('ArrowUp');
      await page.getByLabel('Waktu Permasalahan Diterima').press('ArrowUp');
      await page.getByLabel('Waktu Permasalahan Diterima').press('Tab');
      await page.getByLabel('Waktu Permasalahan Diterima').press('ArrowUp');
      await page.getByLabel('Waktu Permasalahan Diterima').press('ArrowUp');
      await page.getByLabel('Waktu Permasalahan Diterima').press('ArrowUp');
      await page.getByLabel('Waktu Permasalahan Diterima').press('ArrowUp');
      await page.getByLabel('Waktu Permasalahan Diterima').press('ArrowUp');
      await page.getByLabel('Waktu Permasalahan Diterima').press('ArrowUp');
      await page.getByLabel('Waktu Permasalahan Diterima').press('Tab');
      await page.getByLabel('Waktu Permasalahan Diterima').press('ArrowUp');
      await page.getByPlaceholder('masukkan detail lokasi').fill('Kantor desa');
      await page.getByPlaceholder('masukkan uraian problem').fill(uraian);

      await page.getByPlaceholder('Tuliskan minimal 5 kata kunci').fill('ekonomi');

      await page.getByPlaceholder('Tuliskan minimal 5 kata kunci').fill('E');
      await page.getByPlaceholder('Tuliskan minimal 5 kata kunci').click();
      await page.getByPlaceholder('Tuliskan minimal 5 kata kunci').fill('Ekonomi');

      await expect(page.locator('li').filter({ hasText: /^ekonomi warga$/ })).toBeVisible({
        timeout: 15000
      });
      await page.locator('li').filter({ hasText: /^ekonomi warga$/ }).click();

      // tab2
      await page.getByRole('heading', { name: 'Narasumber Pemberi Informasi' }).click();
      await page.getByPlaceholder('masukkan nama narasumber').fill(nama);
      await page.getByPlaceholder('masukkan pekerjaan narasumber').fill('Wiraswasta');
      await page.getByPlaceholder('masukkan alamat detail').fill(`Dusun ${dusun}, RT ${rt}, RW ${rw}, ${kecamatan}, ${kabupaten}`);

      // tab3
      await page.getByRole('heading', { name: 'Solusi Problem Solving' }).click();
      await page.getByPlaceholder('nama pihak, pisahkan dengan').fill('Kepala Desa, Bhabinkamtibmas, Bhabinsa, Warga Masyarakat');
      await page.getByLabel('Hari Permasalahan Selesai').selectOption('Senin');
      
      await page.getByLabel('Tanggal Permasalahan Selesai').fill(dateToday);
      await page.getByPlaceholder('masukkan uraian solusi').fill(uraian);
      // submit
      await page.getByRole('button', { name: 'Simpan' }).click();
      // alert
      try {
      await expect(page.getByRole('button', { name: 'OK' })).toBeVisible();
      } catch (error) {
        console.log(error);
      }
      await page.screenshot({ path: `C:/laragon/www/bosv2/auto/screenshots/ps2_${index}.png`, });
  
      await page.close();
    });
  })
});

// test.describe('delete', () => {
//   workSheetsFromFile[0].data.slice(0, 45).forEach((value, index) => {
//     if (index == 0) {
//       return;
//     }

//     test(`do delete ${index}`, async ({ browser }) => {
//       const context = await browser.newContext({
//         storageState: './auth.json'
//       });

//       const page = await context.newPage();
//       await page.goto('https://bos.polri.go.id/laporan/dds-warga');
//       await page.getByLabel('Tanggal Kunjungan: activate').click();
//       await page.getByLabel('Tanggal Kunjungan: activate').click();

//       await page.getByRole('row').locator('a').nth(1).click();
//       await expect(page.getByRole('button', { name: 'Hapus' })).toBeVisible();
//       await page.getByRole('button', { name: 'Hapus' }).click();
//       await expect(page.getByRole('heading', { name: 'Operasi Sukses' })).toBeVisible();   
  
//       await page.close();
//     });
//   })
// });

// test.describe('check', async () => {
 
//     test(`do check`, async ({ browser }) => {
//       const context = await browser.newContext({
//         storageState: './auth.json'
//       });

//       const page = await context.newPage();
//       await page.goto('https://bos.polri.go.id/laporan/dds-warga');
//     });
// });