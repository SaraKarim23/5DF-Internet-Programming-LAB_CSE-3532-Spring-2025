import { Swiper, SwiperSlide } from 'swiper/react';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation';

// import required modules
import { Autoplay, Pagination, Navigation } from 'swiper/modules';
import Slide from './Slide';


export default function Carosel() {
  return (
    <div className='container py-10 mx-auto'>
      <Swiper
        spaceBetween={30}
        centeredSlides={true}
        loop={true}
        autoplay={{
          delay: 3000,
          disableOnInteraction: false,
        }}
        pagination={{
          clickable: true,
        }}
        navigation={true}
        modules={[Autoplay, Pagination, Navigation]}
        className="mySwiper"
      >
        <SwiperSlide><Slide image={'https://i.ibb.co/YL7pXLt/pexels-cristian-rojas-8477293.jpg'}  text='Welcome To YumHub, A Best Community Food Bar'></Slide></SwiperSlide>
        <SwiperSlide><Slide image={'https://i.ibb.co/6gWDB2P/pexels-minan1398-1482803.jpg'}  text='Welcome To YumHub, A Best Community
        Food Bar'></Slide></SwiperSlide>
        <SwiperSlide><Slide image={'https://i.ibb.co/LR8ng1j/pexels-reneasmussen-2544829.jpg'}  text='Welcome To YumHub, A Best Community Food Bar'></Slide></SwiperSlide>
      </Swiper>
    </div>
  );
}

