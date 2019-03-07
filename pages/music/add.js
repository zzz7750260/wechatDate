// pages/music/add.js
Page({

  /**
   * 页面的初始数据
   */
  data: {

  },

  /**添加音乐文件 */
  addMusic:function(){
    wx.chooseImage({
      count: 1,
      sizeType: ['original', 'compressed'],
      sourceType: ['album', 'camera'],
      success(res) {
        //console.log(res);
        // tempFilePath可以作为img标签的src属性显示图片
        const tempFilePaths = res.tempFilePaths
        console.log(tempFilePaths);
        wx.getFileInfo({
          filePath: tempFilePaths[0],
          success(res) {
            console.log(res.size)
            console.log(res.digest)
          }
        }),
        //上传音乐文件
        wx.uploadFile({
          url: 'http://localhost/wechatDate/app/api.php', // 仅为示例，非真实的接口地址
          filePath: tempFilePaths[0],
          name: 'file',
          header: {
            'content-type': 'multipart/form-data'
          },
          formData: {
            uid: 'wx00e457135f052af7',
            sessionKey:'19fdb3f8049c194e18b8c1c3a9ae9e89',
            parameter:'music',
            turl:'addMusic',
            title: 'test',
            afilePath: tempFilePaths[0]
          },
          success(res) {
            const data = res.data
            // do something
            console.log(data);
          }         
        }),
          wx.previewImage({
          current: tempFilePaths[0], // 当前显示图片的http链接
          urls: [tempFilePaths[0]] // 需要预览的图片http链接列表
          })
      }
    })
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {

  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})