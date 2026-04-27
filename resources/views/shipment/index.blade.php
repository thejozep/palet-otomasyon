<div class="card" style="background: white; padding: 24px; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: 1px solid #f0f0f0;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px;">
        <h2 style="display: flex; align-items: center; gap: 12px; margin: 0; color: #1e293b; font-size: 1.5rem;">
            <span style="background: #e0f2fe; padding: 10px; border-radius: 12px;">🚚</span> 
            Sevkiyat Paneli
        </h2>
        
        <div style="display: flex; align-items: center; gap: 15px;">
            <span style="color: #64748b; font-size: 0.85rem; font-weight: 500;">{{ auth()->user()->name }} | İnegöl Tesisleri</span>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" style="background: #fee2e2; color: #dc2626; border: none; padding: 8px 16px; border-radius: 10px; cursor: pointer; font-weight: 600; font-size: 0.85rem; display: flex; align-items: center; gap: 5px;">
                    <i class="fa-solid fa-right-from-bracket"></i> Güvenli Çıkış
                </button>
            </form>
        </div>
    </div>
    
    <form action="{{ route('shipment.store') }}" method="POST" id="shipmentForm">
        @csrf
        
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; background: #f8fafc; padding: 20px; border-radius: 15px; margin-bottom: 25px;">
            <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569; font-size: 0.9rem;">Gideceği Firma</label>
                <select name="company_id" id="main_company_select" onchange="filterAllPallets(this.value)" style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #e2e8f0;" required>
                    <option value="">Firma Seçiniz...</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569; font-size: 0.9rem;">Araç Plakası</label>
                <input type="text" name="plate_number" placeholder="Örn: 16 PK 123" style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #e2e8f0; text-transform: uppercase;" required>
            </div>

            <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569; font-size: 0.9rem;">Şoför Adı Soyadı</label>
                <input type="text" name="driver_name" placeholder="Şoförün ismi" style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #e2e8f0;" required>
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h4 style="margin: 0; color: #1e293b;">Sevkiyat Detayları</h4>
            <button type="button" onclick="addItem()" style="background: #4f46e5; color: white; border: none; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-weight: 600;">
                + Satır Ekle
            </button>
        </div>

        <div id="items-container">
            <div class="item-row" style="display: grid; grid-template-columns: 2fr 1fr 1.2fr 50px; gap: 15px; margin-bottom: 12px; align-items: end; border: 1px solid #f1f5f9; padding: 15px; border-radius: 12px;">
                <div>
                    <label style="font-size: 0.8rem; color: #94a3b8;">Palet Tipi</label>
                    <select name="items[0][pallet_type_id]" class="pallet-select" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #e2e8f0;" required>
                        <option value="">Önce Firma Seçin</option>
                    </select>
                </div>
                <div>
                    <label style="font-size: 0.8rem; color: #94a3b8;">Miktar</label>
                    <input type="number" name="items[0][quantity]" value="0" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #e2e8f0;" required>
                </div>
                <div>
                    <label style="font-size: 0.8rem; color: #94a3b8;">Isıl İşlem No</label>
                    <input type="text" name="items[0][heat_treatment_no]" placeholder="İşlem No" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #e2e8f0;">
                </div>
                <div></div>
            </div>
        </div>

        <button type="submit" style="background: #10b981; color: white; border: none; padding: 18px; border-radius: 12px; width: 100%; font-weight: 700; cursor: pointer; margin-top: 20px;">
            SEVKİYATI KAYDET
        </button>
    </form>
</div>

<script>
    // ÖNEMLİ: Veriyi JS'e güvenli şekilde aktarıyoruz
    const groupedPallets = @json($palletTypesGrouped);

    function filterAllPallets(companyId) {
        const selects = document.querySelectorAll('.pallet-select');
        selects.forEach(select => {
            const savedValue = select.value;
            select.innerHTML = '<option value="">Palet Seçiniz...</option>';
            
            // companyId string olarak gelebilir, o yüzden == kullanıyoruz
            if (companyId && groupedPallets[companyId]) {
                groupedPallets[companyId].forEach(pallet => {
                    const option = document.createElement('option');
                    option.value = pallet.id;
                    option.text = pallet.name;
                    if(pallet.id == savedValue) option.selected = true;
                    select.appendChild(option);
                });
            } else {
                select.innerHTML = '<option value="">Önce Firma Seçin</option>';
            }
        });
    }

    let itemIndex = 1;
    function addItem() {
        const companyId = document.getElementById('main_company_select').value;
        const container = document.getElementById('items-container');
        
        const row = document.createElement('div');
        row.className = 'item-row';
        row.style = 'display: grid; grid-template-columns: 2fr 1fr 1.2fr 50px; gap: 15px; margin-bottom: 12px; align-items: end; border: 1px solid #f1f5f9; padding: 15px; border-radius: 12px; background: #fff;';
        
        row.innerHTML = `
            <div>
                <select name="items[${itemIndex}][pallet_type_id]" class="pallet-select" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #e2e8f0;" required>
                    <option value="">Palet Seçiniz...</option>
                </select>
            </div>
            <div>
                <input type="number" name="items[${itemIndex}][quantity]" value="0" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #e2e8f0;" required>
            </div>
            <div>
                <input type="text" name="items[${itemIndex}][heat_treatment_no]" placeholder="İşlem No" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #e2e8f0;">
            </div>
            <div style="padding-bottom: 5px;">
                <button type="button" onclick="this.parentElement.parentElement.remove()" style="color: #ef4444; cursor: pointer; border: none; background: #fee2e2; width: 35px; height: 35px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            </div>
        `;
        
        container.appendChild(row);
        const newSelect = row.querySelector('.pallet-select');
        
        // Yeni eklenen satırı mevcut firma seçimine göre doldur
        if (companyId && groupedPallets[companyId]) {
            groupedPallets[companyId].forEach(pallet => {
                const option = document.createElement('option');
                option.value = pallet.id;
                option.text = pallet.name;
                newSelect.appendChild(option);
            });
        }
        
        itemIndex++;
    }
</script>