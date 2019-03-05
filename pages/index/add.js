// pages/index/add.js
Page({

  /**
   * 页面的初始数据
   */
  data: {

  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {

  },
  /**改变日期 */
  bindDateChange:function(e){
    this.setData({
      date:e.detail.value,
    })
  },

  /**提交表单 */
  formSubmit:function(e){
    console.log(e.detail.value);
    if (e.detail.value.title && e.detail.value.text && e.detail.value.date){
      //是否公开
      var temp;
      if (e.detail.value.status) {
        temp = 1;
      }
      else {
        temp = 0;
      }
      /**向后端提交数据 */
      wx.request({
        url: 'http://localhost/wechatDate/app/api.php',
        data:{
          parameter:'diary',
          turl:'addDiary',
          token: getApp().globalData.userInfo.dev_token,
          author:wx.getStorageSync('username'),
          title:e.detail.value.title,
          text:e.detail.value.text,
          date:e.detail.value.date,
          status:temp
        },
        method:"POST",
        header:{
          'content-type':'application/x-www-form-urlencoded'
        },
        success:function(res){
          console.log(res.data);
          if(res.data.status == 1){
            wx.showToast({
              title: '添加成功',
              icon: 'loading',
              duration: 2000,
              success: function(res) {
                wx.redirectTo({
                  url: './home',
                })
              },
            })
          }
        }
      })
    }
    else{
      wx.showToast({
        title: '标题,日期,内容不能为空',
        icon:'loading',
        duration:2000
      })
    }
    
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