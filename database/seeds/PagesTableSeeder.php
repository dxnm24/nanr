<?php

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'name' => 'Liên Hệ',
            'slug' => 'lien-he',
            'summary' => '%ContactForm%',
            'description' => '<p>Nếu có bất kỳ thắc mắc nào về website hoặc có yêu cầu hỗ trợ bạn hãy gửi thông tin liên lạc đầy đủ theo mẫu nhập dữ liệu trên đây. Website luôn hoan nghênh mọi ý kiến đóng góp của các bạn. Để biết thêm về chính sách hoạt động của trang web, mời bạn đọc thêm tại trang <strong><a href="/chinh-sach-bao-mat">chính sách bảo mật</a></strong>.</p>',
            'image' => '',
            'meta_title' => '',
            'meta_keyword' => '',
            'meta_description' => '',
            'meta_image' => '',
            'status' => ACTIVE,
            'lang' => VI,
        ]);
        Page::create([
        	'name' => 'Chính Sách Bảo Mật',
            'slug' => 'chinh-sach-bao-mat',
            'summary' => '',
            'description' => '<p><strong>Website của chúng tôi thu thập những gì từ bạn?</strong></p>
<p>Trang web của chúng tôi thu thập thông tin do bạn cung cấp khi bạn sử dụng mẫu nhập dữ liệu trên website như mẫu gửi thông tin liên hệ, phản hồi hoặc bình luận. Khi gửi mẫu dữ liệu liên hệ, bạn có thể cung cấp họ tên, địa chỉ email, số điện thoại, cũng như tin nhắn yêu cầu của bạn cho chúng tôi.</p>
<p><strong>Chúng tôi sử dụng thông tin bạn cung cấp để làm gì?</strong></p>
<p>Những thông tin bạn cung cấp cho website sẽ được sử dụng vào những mục đích như sau:</p>
<p>- Cải thiện trải nghiệm người dùng. Chúng tôi luôn muốn xây dựng một website với những trải nghiệm tốt nhất cho người truy cập. Thông tin của bạn sẽ giúp ích rất nhiều trong việc cải thiện chất lượng website cả về tính thẩm mỹ và thao tác thuận tiện trên website, nâng cao trải nghiệm thực tế của người sử dụng.</p>
<p>- Cải thiện website. Thông tin đóng góp của bạn về website, các thông báo lỗi, hoặc các phản hồi về giao diện người dùng sẽ giúp chúng tôi tổng hợp các mục cần thiết nhất để từng bước xây dựng website ổn định hơn, thân thiện hơn.</p>
<p>- Cải thiện dịch vụ. Nếu bạn có nhu cầu hỗ trợ, bạn có thể yêu cầu với chúng tôi bằng cách sử dụng biểu mẫu trên trang liên hệ để gửi cho chúng tôi yêu cầu cụ thể của bạn. Chúng tôi sẽ dựa trên những thông tin bạn cung cấp để đáp ứng tốt hơn nhu cầu của bạn. Ví dụ đối với email bạn cung cấp cho website, chúng tôi có thể gửi cho bạn các bài viết mới nhất, nổi bật nhất cho bạn định kỳ hàng tuần, hàng tháng.</p>
<p><strong>Bảo vệ thông tin cá nhân của bạn</strong></p>
<p>Các thông tin cá nhân của bạn được cung cấp với website dựa trên duy nhất một biểu mẫu ở trang liên hệ. Thông tin bao gồm họ tên, địa chỉ email, số điện thoại và tin nhắn yêu cầu của bạn. Các thông tin này sẽ được lưu trữ trên máy chủ của website. Một loạt các biện pháp an toàn được sử dụng để đảm bảo sự toàn vẹn của những thông tin cá nhân này.</p>
<p>Chúng tôi không cung cấp cho bên thứ ba bất cứ thông tin cá nhân nào của người truy cập website, bao gồm mọi hình thức như buôn bán, chuyển giao cho các cá nhân, tổ chức bên ngoài. Điều này không bao gồm những cá nhân đáng tin cậy, những cá nhân điều hành website, cũng như các hoạt động khác liên quan đến website. Các bên được cung cấp thông tin phải tuân thủ quy tắc giữ an toàn, bí mật cho các thông tin đó.</p>
<p><strong>Website sử dụng cookies hay không?</strong></p>
<p>Cookies là những file nhỏ nằm trên máy tính của người dùng, được tạo ra sau khi người dùng truy cập vào website. Nó cho phép các trang web nhận diện trình duyệt của người sử dụng và các thông tin nhất định. Chúng tôi sử dụng cookies để cải thiện chất lượng website bằng cách tổng hợp các thông tin mà người dùng cung cấp khi truy cập vào website. Một trong những bên thứ ba sử dụng cookies trên trang web là Google.</p>
<p><strong> Các liên kết từ bên thứ ba</strong></p>
<p>Trên website xuất hiện các liên kết từ bên thứ ba, những trang web của họ có các chính sách bảo mật riêng biệt, độc lập. Vì vậy, chúng tôi không chịu trách nhiệm về nội dung và hoạt động của các liên kết đó.</p>
<p><strong>Sự đồng ý của bạn</strong></p>
<p>Bằng việc sử dụng website, bạn đã đồng ý với các chính sách bảo mật của chúng tôi. Chúng tôi luôn hoan nghênh các đóng góp về website từ người dùng. Mọi góp ý xin gửi theo mẫu form <strong><a href="/lien-he">liên hệ</a></strong>.</p>',
            'image' => '',
            'meta_title' => '',
            'meta_keyword' => '',
            'meta_description' => '',
            'meta_image' => '',
            'status' => ACTIVE,
            'lang' => VI,
        ]);
    }
}
