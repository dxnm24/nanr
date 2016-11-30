<?php

use Illuminate\Database\Seeder;
// use App\Models\PostTagRelation;
use App\Models\PostTypeRelation;
use App\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i=1;
        while($i < 50) {
            Post::create([
                'name' => 'Cách nấu chè bưởi ngon tại nhà',
                'slug' => 'cach-nau-che-buoi-ngon-tai-nha'.$i,
                'type_main_id' => 1,
                'seri' => 0,
                'related' => 0,
                'type' => 0,
                'url' => '',
                'summary' => 'Chè bưởi là món ăn dân dã phù hợp với mọi lứa tuổi, với đặc tính mát và lành, thật là sảng khoái khi được thưởng thức những cốc chè bưởi mát lạnh trong ngày hè nóng bức. Tuy nhiên, bạn đã bao giờ thắc mắc xem những cốc chè bưởi vỉa hè được làm ra như thế nào? Liệu có vệ sinh? Hôm nay nauanngonre.com sẽ truyền cho bạn cách nấu chè bưởi ngay tại nhà vừa ngon vừa đảm bảo an toàn vệ sinh.',
                'description' => '<ol style="text-align: justify;">\r\n<li><strong>Nguyên liệu cần có:</strong>\r\n<ul>\r\n<li> 200-300g bưởi lột vỏ Đậu Xanh ngâm nước trước tầm 45p – 1h.</li>\r\n<li>200g đỗ xanh xát vỏ</li>\r\n<li>Đường ( Tùy khẩu vị mỗi người có thể cho 3-4 muỗng cafe)</li>\r\n<li>Nước cốt dừa</li>\r\n<li>30-50g bột năng</li>\r\n</ul>\r\n</li>\r\n<li><strong>Cách làm:</strong>\r\n<ul>\r\n<li>Làm cùi bưởi: Bưởi lột lấy cùi bằng cách dùng dao mỏng rạch từ ngoài vào trong, chia phần vỏ thành từng múi cách nhau chừng 4cm sẽ vừa dễ lột vừa có được nguyên miếng dày và khéo tay lột sao chỈ một lớp vỏ đến sát ruột mới cho phần vỏ xốp trắng dày đều. Dùng dao bén lạng bỏ phần vỏ xanh ngoài, chỉ lấy phần cùi xốp trắng và xắt hạt lựu.</li>\r\n<li>Trộn đều muối với cùi bưởi đã xắt nhỏ. Chú ý bóp nhẹ tay, không để nát vỏ. Bóp kỹ trong khoảng vài phút rồi cho vào rổ, xả qua nước lạnh cho sạch muối rồi vắt ráo nước.</li>\r\n<li>Làm lại quy trình trên khoảng 2 lần. Nếm thử cùi bưởi nếu thấy hết đắng và hết vị cay – the là được. Trong trường hợp chưa hết vị đắng, luộc cùi bưởi sơ với nước rồi vắt kiệt. Ướp cùi bưởi với một ít đường khoảng 1 tiếng.</li>\r\n<li>Lăn khô cùi bưởi đã ướp đường với bột năng trong một tô lớn. Bước này gọi là bọc áo bột năng cho cùi bưởi. Lớp áo bột năng sẽ giúp phần cùi bưởi giòn giòn, dai dai rất ngon. Khi nấu, cùi bưởi sẽ không bị nát.</li>\r\n<li>Đun nước thật sôi rồi thả cùi bưởi vào, đến khi cùi bưởi nổi lên mặt nước thì lấy thìa khấy nhẹ tay. Khi cùi bưởi chuyển sang màu trắng trong thì vớt ra, đổ vào một ấu nước lạnh (nước đá thì càng tốt, giúp cùi bưởi mau cứng và giòn hơn).</li>\r\n<li>Ngâm trong nước lạnh khoảng 15 phút rồi đổ ra để ráo nước.</li>\r\n<li>Đun sôi một nồi nước khác, cho đường và khuấy tan (định lượng tùy khẩu vị). Cho đỗ xanh vào đun khoảng 10 phút, nếm thử thấy đỗ vừa chín tới là được.</li>\r\n<li>Hòa bột năng với nước rồi đổ từ từ vào nồi, vừa đổ vừa khấy đều cho đến khi thấy nước chè bắt đầu sánh lại (không nên làm đặc quá). Cho tiếp cùi bưởi vào, khuấy đều ở mức lửa nhỏ. Cho tiếp hoa bưởi vào để tạo mùi thơm (có thể thay thế bằng tinh chất vani). Khi chè bắt đầu sôi thì tắt bếp.</li>\r\n<li>Sau khi đã nấu xong, để tăng phần ngon miệng, bạn có thể thêm một chút nước cốt dừa.</li>\r\n</ul>\r\n</li>\r\n<li><strong>Đánh giá và thưởng thức:</strong>\r\n<ul>\r\n<li>Món <strong>chè bưởi</strong> có vị ngọt thanh vừa ăn, có mùi thơm đặc trưng rất hấp dẫn, cùi bưởi ngọt nhẹ, giòn, dai, đậu xanh chín mềm góp phần làm nên vị ngon đặc trưng của <em>món chè</em> hấp dẫn này.</li>\r\n<li>Nước <strong>chè bưởi</strong> sền sệt, khi ăn kèm với nước cốt dừa và đậu phộng rang sẵn rất thơm ngon và kích thích khẩu vị hiệu quả</li>\r\n<li><strong>Cách thưởng thức món chè bưởi ngon đúng chuẩn:</strong> Với món chè này, bạn có thể ăn nóng, ăn lạnh tùy theo sở thích và thời tiết nhé:</li>\r\n<li>Ăn nóng: Múc <strong>chè bưởi</strong> ra bát, cho lên bên trên mọt ít nước cốt dừa và đậu phộng giã nhỏ là có thể thưởng thức rồi.</li>\r\n<li>Ăn lạnh: Múc chè bưởi ra ½ ly lớn, cho phần đá bào lên trên, tiếp đó bạn cho nước cốt dừa, đậu phộng giã nhỏ lên phía trên đá bào và ½ – 1 thìa nước cốt chanh tùy thích là có thể thưởng thức rồi nhé.</li>\r\n</ul>\r\n</li>\r\n</ol>\r\n<p style="text-align: justify;">Nauanngonre vừa chia sẻ cho bạn cach nau che buoi ngon và vệ sinh tại nhà, chúc các bạn ngon miệng!</p>',
                'image' => '/images/thumb/760x460.jpg',
                'meta_title' => '',
                'meta_keyword' => '',
                'meta_description' => '',
                'start_date' => date('Y-m-d H:i:s'),
                'position' => 1,
                'status' => ACTIVE,
                'lang' => VI,
            ]);
            $i++;
            PostTypeRelation::insert([
                'post_id' => $i,
                'type_id' => 1,
            ]);
            // PostTagRelation::insert([
            //     'post_id' => $i,
            //     'tag_id' => 1,
            // ]);
        }
    }
}
