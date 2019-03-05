// pages/index/manager.js

//设置日志列表
var diaryList;

Page({

  /**
   * 页面的初始数据
   */
  data: {
    items: [
      {
        id: 1,
        username: 'admin1',
        title: '测试1',
        date: '2018-12-02'
     }
    ],
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    /**向后端发送请求 */
    //根据是否有参数来判断是否删除，如果有参数为删除
    if(options.id == null){
      this.listArticle();
    }
    else{
      this.delDiary(options.id);
      //这些需要用that更变作用域
      //var that = this;
      setTimeout(function(){
        //that.listArticle()
        wx.redirectTo({
          url: 'manager',
        })
       },2000);

    }

  },

  /**获取日志列表 */
  listArticle:function(){
    wx.request({
      url: 'http://localhost/wechatDate/app/api.php',
      data:{
        parameter:'diary',
        turl:'listDiary',
        theUserToken: getApp().globalData.userInfo.dev_token,        
      },
      method:'GET',
      header:{
        'content-type':'application/json'
      },
      success:function(res){
        console.log(res.data);
        if(res.data.status == 1){
          //将日志列表传给全局
          diaryList = res.data.result;
        }
        else{
          wx.showToast({
            title:res.data.msg,
            icon:'loading',
            duration:2000
          })
        }
      }
    })
  },

  /**删除日志 */
  delDiary:function(theId){
    wx.request({
      url: 'http://localhost/wechatDate/app/api.php',
      data:{
        parameter:'diary',
        turl:'delArticle',
        token:getApp().globalData.userInfo.dev_token,
        id:theId
      },
      method:'GET',
      header:{
        'content-type': 'application/json'
      },
      success:function(res){
        console.log(res.data);
        wx.showToast({
          title: res.data.msg,
          icon:'loading',
          duration:2000
        })
      }
    })
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {
    this.setData({
      items:diaryList,
    })
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