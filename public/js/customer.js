
    const defaultConfig = {
      brand_name: 'Mạnh Hùng',
      slogan: 'An toàn - Chất lượng - Đúng giờ',
      hotline: '1900 6868',
      promo_text: 'Giảm 20% cho khách hàng mới - Nhập mã: MANHHUNG20',
      primary_color: '#1e3a5f',
      accent_color: '#f59e0b',
      text_color: '#1f2937',
      background_color: '#f9fafb',
      surface_color: '#ffffff'
    };

    let config = { ...defaultConfig };

    const cities = {
      hanoi: 'Hà Nội',
      hochiminh: 'TP. Hồ Chí Minh',
      danang: 'Đà Nẵng',
      haiphong: 'Hải Phòng',
      nhatrang: 'Nha Trang',
      dalat: 'Đà Lạt',
      cantho: 'Cần Thơ',
      hue: 'Huế'
    };

    const routes = [
      { from: 'hanoi', to: 'hochiminh', price: 650000, duration: '30 tiếng', departures: ['06:00', '08:00', '18:00', '20:00'] },
      { from: 'hochiminh', to: 'hanoi', price: 650000, duration: '30 tiếng', departures: ['06:00', '08:00', '18:00', '20:00'] },
      { from: 'hochiminh', to: 'nhatrang', price: 280000, duration: '9 tiếng', departures: ['07:00', '09:00', '21:00', '22:00'] },
      { from: 'nhatrang', to: 'hochiminh', price: 280000, duration: '9 tiếng', departures: ['07:00', '09:00', '21:00', '22:00'] },
      { from: 'hochiminh', to: 'dalat', price: 220000, duration: '7 tiếng', departures: ['06:30', '08:30', '20:00', '22:00'] },
      { from: 'dalat', to: 'hochiminh', price: 220000, duration: '7 tiếng', departures: ['06:30', '08:30', '20:00', '22:00'] },
      { from: 'hanoi', to: 'hue', price: 350000, duration: '13 tiếng', departures: ['07:00', '19:00', '20:00'] },
      { from: 'hue', to: 'hanoi', price: 350000, duration: '13 tiếng', departures: ['07:00', '19:00', '20:00'] },
      { from: 'hanoi', to: 'danang', price: 380000, duration: '16 tiếng', departures: ['06:00', '18:00', '19:00'] },
      { from: 'danang', to: 'hanoi', price: 380000, duration: '16 tiếng', departures: ['06:00', '18:00', '19:00'] },
      { from: 'hochiminh', to: 'cantho', price: 150000, duration: '4 tiếng', departures: ['06:00', '08:00', '10:00', '14:00', '16:00'] },
      { from: 'cantho', to: 'hochiminh', price: 150000, duration: '4 tiếng', departures: ['06:00', '08:00', '10:00', '14:00', '16:00'] }
    ];

    let selectedTrip = null;

    function onConfigChange(cfg) {
      config = { ...defaultConfig, ...cfg };
      
      document.getElementById('brand-name').textContent = config.brand_name || defaultConfig.brand_name;
      document.getElementById('slogan').textContent = config.slogan || defaultConfig.slogan;
      document.getElementById('hotline').textContent = config.hotline || defaultConfig.hotline;
      document.getElementById('promo-text').textContent = config.promo_text || defaultConfig.promo_text;
      document.getElementById('footer-brand').textContent = config.brand_name || defaultConfig.brand_name;
    }

    function formatPrice(price) {
      return new Intl.NumberFormat('vi-VN').format(price) + 'đ';
    }

    function searchTrips(from, to, date, tickets) {
      const results = routes.filter(r => r.from === from && r.to === to);
      return results.map(route => ({
        ...route,
        date,
        tickets,
        total: route.price * tickets
      }));
    }

    function renderResults(trips) {
      const container = document.getElementById('results-container');
      const resultsSection = document.getElementById('results');
      
      if (trips.length === 0) {
        container.innerHTML = `
          <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 text-center">
            <p class="text-amber-700 font-medium">Không tìm thấy chuyến xe phù hợp. Vui lòng thử tuyến đường khác.</p>
          </div>
        `;
        resultsSection.classList.remove('hidden');
        return;
      }

      container.innerHTML = trips.flatMap(trip => 
        trip.departures.map(time => `
          <div class="bg-white rounded-xl card-shadow p-5 hover:shadow-lg transition-shadow">
            <div class="flex flex-wrap items-center justify-between gap-4">
              <div class="flex items-center gap-6">
                <div class="text-center">
                  <p class="text-2xl font-bold text-gray-800">${time}</p>
                  <p class="text-sm text-gray-500">${cities[trip.from]}</p>
                </div>
                <div class="flex items-center gap-2">
                  <div class="w-2 h-2 bg-amber-500 rounded-full"></div>
                  <div class="w-20 h-0.5 bg-gradient-to-r from-amber-500 to-blue-500"></div>
                  <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 16c0 .88.39 1.67 1 2.22V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h8v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1.78c.61-.55 1-1.34 1-2.22V6c0-3.5-3.58-4-8-4s-8 .5-8 4v10z"/>
                  </svg>
                  <div class="w-20 h-0.5 bg-gradient-to-r from-blue-500 to-green-500"></div>
                  <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                </div>
                <div class="text-center">
                  <p class="text-sm text-gray-500">${trip.duration}</p>
                  <p class="text-sm text-gray-500">${cities[trip.to]}</p>
                </div>
              </div>
              
              <div class="flex items-center gap-4">
                <div class="text-right">
                  <p class="text-sm text-gray-500">${trip.tickets} vé x ${formatPrice(trip.price)}</p>
                  <p class="text-xl font-bold text-amber-600">${formatPrice(trip.total)}</p>
                </div>
                <button onclick="selectTrip('${trip.from}', '${trip.to}', '${time}', '${trip.date}', ${trip.price}, ${trip.tickets})" class="btn-primary text-white font-medium px-6 py-3 rounded-xl">
                  Chọn
                </button>
              </div>
            </div>
            
            <div class="flex flex-wrap gap-2 mt-4">
              <span class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">Giường nằm</span>
              <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">Wifi miễn phí</span>
              <span class="bg-purple-100 text-purple-700 text-xs px-3 py-1 rounded-full">Điều hòa</span>
              <span class="bg-amber-100 text-amber-700 text-xs px-3 py-1 rounded-full">Nước uống</span>
            </div>
          </div>
        `)
      ).join('');

      resultsSection.classList.remove('hidden');
      resultsSection.scrollIntoView({ behavior: 'smooth' });
    }

    function selectTrip(from, to, time, date, price, tickets) {
      selectedTrip = { from, to, time, date, price, tickets };
      
      const detailsContainer = document.getElementById('booking-details');
      detailsContainer.innerHTML = `
        <div class="bg-gray-50 rounded-xl p-4">
          <div class="flex items-center justify-between mb-3">
            <span class="font-bold text-gray-800">${cities[from]} → ${cities[to]}</span>
            <span class="bg-amber-100 text-amber-700 text-sm font-medium px-3 py-1 rounded-full">Giường nằm</span>
          </div>
          <div class="grid grid-cols-2 gap-3 text-sm">
            <div>
              <p class="text-gray-500">Ngày đi</p>
              <p class="font-medium text-gray-800">${date}</p>
            </div>
            <div>
              <p class="text-gray-500">Giờ khởi hành</p>
              <p class="font-medium text-gray-800">${time}</p>
            </div>
            <div>
              <p class="text-gray-500">Số vé</p>
              <p class="font-medium text-gray-800">${tickets} vé</p>
            </div>
            <div>
              <p class="text-gray-500">Tổng tiền</p>
              <p class="font-bold text-amber-600">${formatPrice(price * tickets)}</p>
            </div>
          </div>
        </div>
      `;
      
      document.getElementById('booking-modal').classList.remove('hidden');
      document.getElementById('booking-modal').classList.add('flex');
    }

    function closeModal() {
      document.getElementById('booking-modal').classList.add('hidden');
      document.getElementById('booking-modal').classList.remove('flex');
    }

    function showToast(message) {
      const toast = document.getElementById('success-toast');
      document.getElementById('toast-message').textContent = message;
      toast.classList.remove('translate-y-full', 'opacity-0');
      
      setTimeout(() => {
        toast.classList.add('translate-y-full', 'opacity-0');
      }, 3000);
    }

    function confirmBooking() {
      const name = document.getElementById('passenger-name').value.trim();
      const phone = document.getElementById('passenger-phone').value.trim();
      const email = document.getElementById('passenger-email').value.trim();
      
      if (!name || !phone) {
        showToast('Vui lòng nhập đầy đủ thông tin!');
        return;
      }
      
      closeModal();
      showToast('🎉 Đặt vé thành công! Chúng tôi sẽ liên hệ xác nhận.');
      
      document.getElementById('passenger-name').value = '';
      document.getElementById('passenger-phone').value = '';
      document.getElementById('passenger-email').value = '';
    }

    // Event Listeners
    const searchForm = document.getElementById('search-form');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            // Frontend validation only
            const from = document.getElementById('from-city').value;
            const to = document.getElementById('to-city').value;
            
            if (!from || !to) {
                e.preventDefault();
                showToast('Vui lòng chọn đầy đủ thông tin!');
                return;
            }
            
            if (from === to) {
                e.preventDefault();
                showToast('Điểm đi và điểm đến không được trùng nhau!');
                return;
            }
            // Let the form submit to backend
        });
    }

    document.getElementById('close-modal').addEventListener('click', closeModal);
    document.getElementById('confirm-booking').addEventListener('click', confirmBooking);
    
    document.getElementById('booking-modal').addEventListener('click', function(e) {
      if (e.target === this) closeModal();
    });

    document.getElementById('contact-form').addEventListener('submit', function(e) {
      e.preventDefault();
      showToast('Cảm ơn bạn! Chúng tôi sẽ liên hệ sớm nhất.');
      this.reset();
    });

    // Removed default date setter because date field was removed from view

    // Initialize Element SDK
    if (window.elementSdk) {
      window.elementSdk.init({
        defaultConfig,
        onConfigChange,
        mapToCapabilities: (cfg) => ({
          recolorables: [
            {
              get: () => cfg.primary_color || defaultConfig.primary_color,
              set: (value) => { cfg.primary_color = value; window.elementSdk.setConfig({ primary_color: value }); }
            },
            {
              get: () => cfg.accent_color || defaultConfig.accent_color,
              set: (value) => { cfg.accent_color = value; window.elementSdk.setConfig({ accent_color: value }); }
            },
            {
              get: () => cfg.text_color || defaultConfig.text_color,
              set: (value) => { cfg.text_color = value; window.elementSdk.setConfig({ text_color: value }); }
            },
            {
              get: () => cfg.background_color || defaultConfig.background_color,
              set: (value) => { cfg.background_color = value; window.elementSdk.setConfig({ background_color: value }); }
            },
            {
              get: () => cfg.surface_color || defaultConfig.surface_color,
              set: (value) => { cfg.surface_color = value; window.elementSdk.setConfig({ surface_color: value }); }
            }
          ],
          borderables: [],
          fontEditable: undefined,
          fontSizeable: undefined
        }),
        mapToEditPanelValues: (cfg) => new Map([
          ['brand_name', cfg.brand_name || defaultConfig.brand_name],
          ['slogan', cfg.slogan || defaultConfig.slogan],
          ['hotline', cfg.hotline || defaultConfig.hotline],
          ['promo_text', cfg.promo_text || defaultConfig.promo_text]
        ])
      });
    }

    // Initial render
    onConfigChange(config);
